<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Notifications\ResetPassword;

class SimpleTest extends TestCase
{
	use RefreshDatabase;
	
	/*
	*
	* Ensure that the login page shows up when requested
	*
	*/
    public function testCanViewLogin()
	{
		//make request for login page
		$response = $this->get('/login');
		
		//assert the request was successful
		$response->assertSuccessful();
		
		//assert that the current view is indeed login
		$response->assertViewIs('auth.login');
	}
	
	/*
	*
	* Once the user has been authenticated (logged in) they are not supposed to be able to see the login page anymore
	*
	*/
	public function testCantSeeHomeOnceAuth()
	{
		//make a temporary user
		$user=factory(User::class)->make();
		
		//once logged in as a user, request the login page
		$response=$this->actingAs($user)->get('/login');
		
		//assert that the user has been correctly redirected to the home view instead
		$response->assertRedirect('/home');
	}	
	
	/*
	*
	* Once an user exists in database, they can login if giving correct credentials
	*
	*/
	public function testCanLogin()
	{
		//make a new user with a specific password, the other credentials don't matter, here we leave it to laravel to decide the other credentials
		$user=factory(User::class)->create(['password'=>bcrypt($password='12345678'),]);
		
		//send post request to login page with given credentials
		$response=$this->post('/login',['email'=>$user->email,'password'=>$password,]);
		
		//assert that the user has been correctly redirected to the home view
		$response->assertRedirect('/home');
		
		//assert that the user has been correctly authenticated
		$this->assertAuthenticatedAs($user);
	}	
	
	/*
	*
	* If an user provides incorrect credentials, they cannot login and will be indicated so
	*
	*/
	public function testIncorrectCredentials()
	{
		//make a new user with a specific password
		$user=factory(User::class)->create(['password'=>bcrypt($password='12345678'),]);
		
		//send post request to login page with given credentials
		//here, before post we also tell it that we are from the login page so that we get properly redirected there when the login fails
		$response=$this->from('/login')->post('/login',['email'=>$user->email,'password'=>'incorrect_password',]);
		
		//assert that the user has been correctly redirected to the login view
		$response->assertRedirect('/login');
		
		//assert that there is an error on the email field (the error is not the email but the error message is shown on the email field)
		$response->assertSessionHasErrors('email');
		
		//assert that the inputted email remained in the field
		$this->assertTrue(session()->hasOldInput('email'));
		
		//assert that the inputted password DID NOT remain in the field
		$this->assertFalse(session()->hasOldInput('password'));
		
		//assert that no user is logged in
		$this->assertGuest();
	}	
	
	/*
	*
	* If an user checks the "remember me", a cookie will be created with the correct data
	*
	*/
	public function testRememberMe()
	{
		//make a new user with a random id and a specific password
		$user=factory(User::class)->create(['id'=>random_int(1,100),'password'=>bcrypt($password='12345678'),]);
		
		//send post request to login page with given credentials
		$response=$this->post('/login',['email'=>$user->email,'password'=>$password,'remember'=>'on',]);
		
		//assert that the user has been correctly redirected to the home view
		$response->assertRedirect('/home');
		
		//assert the cookie
		$response->assertCookie(Auth::guard()->getRecallerName(),vsprintf('%s|%s|%s',[$user->id,$user->getRememberToken(),$user->password,]));
		
		//assert that the user has been correctly authenticated
		$this->assertAuthenticatedAs($user);
	}
	
	/*
	*
	* An user can request a password reset
	*
	*/
	public function testPasswordReset()
	{
		//this is just a test we don't actually want to send an email we just want to test the functionality
		Notification::fake();
		
		//make a new user
		$user=factory(User::class)->create();
		
		//send post request to reset password/email given the newly created user's email
		$response=$this->post('/password/email',['email'=>$user->email,]);
		
		//assert that an notification has been sent to the user (that a notification token in now present in DB)
		//get the token from DB
		$token=DB::table('password_resets')->first();
		
		//assert that the token is not null (that it exists)
		$this->assertNotNull($token);
		
		//assert that the notification token is the token that resulted from the request from the newly created user
		Notification::assertSentTo($user,ResetPassword::class,function ($notification,$channels) use ($token){
			return Hash::check($notification->token,$token->token)===true;
		});
	}
}
