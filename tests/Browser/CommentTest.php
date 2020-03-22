<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CommentTest extends DuskTestCase
{
    /**
     * Ensure we can comment on a post
     */
    public function testComment()
    {
        $user0 = factory(User::class)->create([
            'password' => bcrypt('password') // Create an user 0 with specific password "password"
        ]);
		
        $this->browse(function (Browser $browser) use ($user0) {
			
            $browser->visit('/login') // go to login page
					->type('email',$user0->email) // type in user email
					->type('password','password') // type in user password
					->press('Login') // press login button
					->visit('/posts/create') // go to post creation page
                    ->type('body','Test body') // type in a body
                    ->type('title','Test Title') // type in a title
                    ->attach('image','./tests/TestImages/test.png') // attach a test image to the form
					->press('Submit') // submit the form
					->visit('/posts/1') // go to the post's page
					->type('message','Test comment') // type a comment
					->press('SUBMIT') // submit the comment form
					->assertSee('Test comment'); // assert that the comment has been posted
					
        });
    }
    /**
     * Ensure a user can reply to another user's comment
     */
    public function testReply()
    {
        $user1 = factory(User::class)->create([
            'password' => bcrypt('password') // Create an user 1 with specific password "password"
        ]);
		
        $this->browse(function (Browser $browser) use ($user1) {
			
            $browser->visit('/login') // go to login page
					->type('email',$user1->email) // type in user email
					->type('password','password') // type in user password
					->press('Login') // press login button
					->visit('/posts/1') // go to the post's page
					->assertSee('REPLY') // assert that user has access to reply to the comment
					->click('REPLY') // click on reply
					->type('message','Test reply') // type a reply
					->press('REPLY') // submit the comment form
					->assertSee('Test reply'); // assert that the comment has been posted
					
        });
    }
	
    /**
     * Ensure we can edit a comment
     */
    public function testCommentEdit()
    {
        $user0 = User::find(0);
		
        $this->browse(function (Browser $browser) use ($user0) {
			
            $browser->visit('/login') // go to login page
					->type('email',$user0->email) // type in user email
					->type('password','password') // type in user password
					->press('Login') // press login button
					->visit('/posts/1') // go to the post's page
					->type('message','Test comment') // type a comment
					->press('SUBMIT') // submit the comment form
					->assertSee('EDIT') // assert that the poster has access to edit the comment
					->click('EDIT') // click on edit
					->type('message','Edited comment') // edit the comment
					->press('UPDATE') // press update
					->assertSee('Edited comment'); // assert that the comment has been correctly edited
					
        });
    }
	
    /**
     * Ensure we can delete a comment
     */
    public function testCommentDelete()
    {
        $user0 = User::find(0);
		
        $this->browse(function (Browser $browser) use ($user0) {
			
            $browser->visit('/login') // go to login page
					->type('email',$user0->email) // type in user email
					->type('password','password') // type in user password
					->press('Login') // press login button
					->visit('/posts/1') // go to the post's page
					->assertSee('DELETE') // assert that the poster has access to delete the comment
					->click('DELETE') // click on delete
					->assertDontSee('Edited comment'); // assert that the comment has been correctly deleted
					
        });
    }
}
