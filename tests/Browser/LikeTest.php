<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LikeTest extends DuskTestCase
{
    /**
     * Ensure that an user can like another user's post
     */
    public function testLike()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login') // go to login page
					->type('email','follow@follow.com') // type in user email into email field
					->type('password','password') // type in user password into password field;
					->press('Login') // press login button
					->visit('/feed') // go to feed
                    ->assertSeeIn('span.ml-1.badge.badge-light','0') // assert that the like count on the first post in the feed is set to 0
					->press('button.fa.fa-thumbs-up.btn.btn-primary.btn-sm') // press the like button
                    ->assertSeeIn('span.ml-1.badge.badge-light','1'); // assert that the like count is set to 1
        });
    }
}
