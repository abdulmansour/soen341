<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdsTest extends DuskTestCase
{
    /**
     * Ensures an user sees proper add after posting with keywords.
     */
    public function testAds()
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
                    ->type('body','This is a beach') // type in a body
                    ->type('title','A beach') // type in a title
                    ->attach('image','./tests/TestImages/test.png') // attach a test image to the form
					->press('Submit') // submit the form
					->assertPathIs('/posts') // assert that we have been redirected to posts page
					->assertSee('Post Created') // assert that the user has been prompt a post success confirmation
					->assertSeeIn('.ad-title','beach'); // assert that an ad of the proper keyword is displayed
					
        });
    }
}
