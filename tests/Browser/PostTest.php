<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostTest extends DuskTestCase
{
    /**
     * Ensures we can access the post creation page
     */
    public function testAcessPostCreationPage()
    {
		//get request the post creation page
		$response = $this->get('/posts/create');
		
		//ensure that we are on the correct page
		$response->assertViewIs('posts.create');
    }
	
    /**
     * Ensures we cant post if don't have an image
     */
    public function testCantPostWithoutImage()
    {
        $this->browse(function (Browser $browser) {
			
            $browser->visit('/posts/create') // Go to post creation page
                    ->type('title','Test title') // type in a title
                    ->type('body','Test body') // type in a body
					->press('Submit') // submit the post form
					->assertSee('The image field is required.'); // assert that the correct fail happened
					
        });
    }
	
    /**
     * Ensures we cant post if we don't have a body
     */
    public function testCantPostWithoutBody()
    {
        $this->browse(function (Browser $browser) {
			
            $browser->visit('/posts/create') // Go to post creation page
                    ->type('title','Test title') // type in a title
                    ->attach('image','./tests/TestImages/test.png') // attach a test image to the form
					->press('Submit') // submit the form
					->assertSee('The body field is required.'); // assert that the correct fail happened
					
        });
    }
	
    /**
     * Ensures we cant post if we don't have a title
     */
    public function testCantPostWithoutTitle()
    {
        $this->browse(function (Browser $browser) {
			
            $browser->visit('/posts/create') // Go to post creation page
                    ->type('body','Test body') // type in a body
                    ->attach('image','./tests/TestImages/test.png') // attach a test image to the form
					->press('Submit') // submit the form
					->assertSee('The title field is required.'); // assert that the correct fail happened
					
        });
    }
	
    /**
     * Ensures we cant post if no user is logged in
     */
    public function testCantPostWithoutUser()
    {
        $this->browse(function (Browser $browser) {
			
            $browser->visit('/posts/create') // Go to post creation page
                    ->type('body','Test body') // type in body
                    ->type('title','Test Title') // type in title
                    ->attach('image','./tests/TestImages/test.png') // attach test image to form
					->press('Submit') // submit the form
					->assertPathIs('/login') // assert that we have been redirected to the login page
					->assertSee('Login Required'); // assert user has been prompt to login
					
        });
    }
	
    /**
     * Ensures we can post if a user is logged in
     */
    public function testPost()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('password') // Create an user with specific password "password"
        ]);
		
        $this->browse(function (Browser $browser) use ($user) {
			
            $browser->visit('/login') // go to login page
					->type('email',$user->email) // type in user email into email field
					->type('password','password') // type in user password into password field
					->press('Login') // press login button
					->visit('/posts/create') // got to post creation page
                    ->type('body','Test body') // type in a body
                    ->type('title','Test Title') // type in a title
                    ->attach('image','./tests/TestImages/test.png') // attach a test image to the form
					->press('Submit') // submit the form
					->assertPathIs('/posts') // assert that we have been redirected to posts page
					->assertSee('Post Created'); // assert that the user has been prompt a post success confirmation
					
        });
    }
}
