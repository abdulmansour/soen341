<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PagesController extends Controller
{
    public function index() {
        $data = array(
            'title' => 'Welcome to the dev branch!'
        );
        return view('pages.index')->with($data);
    }

    public function profile() {
        $user_id = 1;
        $posts = Post::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();

        return view('pages.profile')->with('posts', $posts)->with('user_id', $user_id);
    }

    public function about() {
        $title = 'About';
        return view('pages.about')->with('title', $title);
    }

}
