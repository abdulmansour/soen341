<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;

class PagesController extends Controller
{
    public function index() {
        $data = array(
            'title' => 'Welcome to the dev branch!'
        );
        return view('pages.index')->with($data);
    }

    public function profile() {
        $user = Auth::user();
        if (!is_null($user)) {
            $posts = Post::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
            return view('pages.profile')->with('posts', $posts)->with('user', $user);
        }
        
        return view('auth.login');
    }

    public function about() {
        $title = 'About';
        return view('pages.about')->with('title', $title);
    }

}
