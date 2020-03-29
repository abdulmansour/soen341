<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FollowTest extends DuskTestCase
{
	
    /**
     * Ensures we can access users page if we are logged in
     */
    public function testCanAccessUsersPage()
    {
		$user = User::first();
		
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login') // go to login page
                    ->assertSee('Login') // assert that we are on login page
					->type('email',$user->email) // type in user email into email field
					->type('password','password') // type in user password into password field;
					->press('Login') // press login button
					->visit('/users') // go to users page
                    ->assertSee('Registered Users:') // assert that we are on users page
					
					//create a new post that we will be able to see in feed once another user follows this user
					->visit('/posts/create') // got to post creation page
                    ->type('body','Follow body') // type in a body
                    ->type('title','Follow title') // type in a title
                    ->attach('image','./tests/TestImages/test.png') // attach a test image to the form
					->press('Submit') // submit the form
					
					->visit('/logout')->logout();
        });
    }
	
    /**
     * Ensures we can follow another user
     */
    public function testFollowCount()
    {
		$user = factory(User::class)->create([ // Create an user 1
			'email' => 'follow@follow.com', // with specific email "follow@follow.com"
            'password' => bcrypt('password') // with specific password "password"
        ]);
		
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login') // go to login page
					->type('email',$user->email) // type in user email into email field
					->type('password','password') // type in user password into password field;
					->press('Login') // press login button
					->visit('/users') // go to users page
                    ->assertSee('Registered Users:') // assert that we are on users page
					->assertDontSee('1') // assert that all following and followers counters are at 0
					->press('Follow') // press the first follow button
					->assertSee('1'); // assert that counters have incremented
        });
    }
	
    /**
     * Ensures that once we follow another user we can see their posts in the feed
     */
    public function testSeeFollowedPost()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/feed')->dump() // go to feed
					->assertSee('Feed from users you are following:') // assert we are on the feed
					->assertSee('Follow title'); // assert the user can see the post of the followed user
        });
    }
}
