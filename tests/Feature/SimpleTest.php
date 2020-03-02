<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
		$user=factory(User::class)->create(['username'=>'loginTestUserName','password'=>bcrypt($password='12345678'),]);
		
		//send post request to login page with given credentials
		$response=$this->post('/login',['email'=>$user->email,'password'=>$password,]);
		
		//assert that the user has been correctly redirected to the home view
		$response->assertRedirect('/home');
		
		//assert that the user has been correctly authenticated
		$this->assertAuthenticatedAs($user);
	}	
}
