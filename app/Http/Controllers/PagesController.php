<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\User;


class PagesController extends Controller
{
    public function index() {
        $data = array(
            'title' => 'Welcome to the master branch!'
        );
        return view('pages.index')->with($data);
    }

    public function profile() {
        $user = Auth::user();
        
        if (!is_null($user)) {
            $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
            return view('pages.profile')->with('posts', $posts)->with('user', $user);
        }

        //if user is not logged in, redirect the user to the login page
        return redirect('login')->with('error', 'Login Required');
    }

    public function about() {
        $title = 'About';
        return view('pages.about')->with('title', $title);
    }

    public function users()
    {
        $users = User::get();
        return view('users', compact('users'));
    }

    public function feed()
    {

        $user = Auth::user();

        if (!is_null($user)) {

            $userIdsOfFollowings = $user->followings()->pluck('id')->toArray();
            //uncomment below if we want to see the posts of the current user as well in the feed
            //$posts = Post::whereIn('user_id', $userIdsOfFollowings)->orWhere('user_id', $user->id)->orderBy('created_at', 'DESC')->get(); 
            $posts = Post::whereIn('user_id', $userIdsOfFollowings)->orderBy('created_at', 'DESC')->get(); 
            foreach($posts as $post) {
                $user = User::find($post->user_id);
                $post->user = $user;
            }
            return view('pages.feed', compact('posts'));
        }

        //if user is not logged in, redirect the user to the login page
        return redirect('login')->with('error', 'Login Required');
    }

}
