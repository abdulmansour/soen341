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
     * Test Travis
     */
    public function testCantPostWithoutImage()
    {
        $this->browse(function (Browser $browser) {
			
            $browser->visit('')
					->assertSee('Posts');
					
        });
    }
	
    /**
     * Ensures we cant post if don't have an image
     */
    public function testCantPostWithoutImage()
    {
        $this->browse(function (Browser $browser) {
			
            $browser->visit('')
					->click('Posts')
					->click('Create Post')
                    ->type('title','Test title')
                    ->type('body','Test body')
					->press('Submit')
					->assertSee('The image field is required.');
					
        });
    }
	
    /**
     * Ensures we cant post if we don't have a body
     */
    public function testCantPostWithoutBody()
    {
        $this->browse(function (Browser $browser) {
			
            $browser->visit('')
					->click('Posts')
					->click('Create Post')
                    ->type('title','Test title')
                    ->attach('image','./tests/testimages/test.png')
					->press('Submit')
					->assertSee('The body field is required.');
					
        });
    }
	
    /**
     * Ensures we cant post if we don't have a title
     */
    public function testCantPostWithoutTitle()
    {
        $this->browse(function (Browser $browser) {
			
            $browser->visit('')
					->click('Posts')
					->click('Create Post')
                    ->type('body','Test body')
                    ->attach('image','./tests/testimages/test.png')
					->press('Submit')
					->assertSee('The title field is required.');
					
        });
    }
	
    /**
     * Ensures we cant post if no user is logged in
     */
    public function testCantPostWithoutUser()
    {
        $this->browse(function (Browser $browser) {
			
            $browser->visit('')
					->click('Posts')
					->click('Create Post')
                    ->type('body','Test body')
                    ->type('title','Test Title')
                    ->attach('image','./tests/testimages/test.png')
					->press('Submit')
					->assertPathIs('/soen341/public/login')
					->assertSee('Login Required');
					
        });
    }
	
    /**
     * Ensures we can post if a user is logged in
     */
    public function testPost()
    {
        $user = factory(User::class)->create([
            'password' => bcrypt('password') // Save the encrypted
        ]);
		
        $this->browse(function (Browser $browser) use ($user) {
			
            $browser->visit('/login')
					->type('email',$user->email)
					->type('password','password')
					->press('Login')
					->click('Posts')
					->click('Create Post')
                    ->type('body','Test body')
                    ->type('title','Test Title')
                    ->attach('image','./tests/testimages/test.png')
					->press('Submit')
					->assertPathIs('/soen341/public/posts')
					->assertSee('Post Created');
					
        });
    }
}
