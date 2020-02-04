<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $data = array(
            'title' => 'Welcome to the dev branch!'
        );
        return view('pages.index')->with($data);
    }

    public function services() {
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }

    public function about() {
        $title = 'About';
        return view('pages.about')->with('title', $title);
    }
}
