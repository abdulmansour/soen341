<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Route;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function users()
    {
        $users = User::get();
        return view('users', compact('users'));
    }

    public function user($id)
    {
        $user = User::find($id);
        return view('usersView', compact('user'));
    }

    public function followUserRequest(Request $request){

        $id = $request->input('id');

        $user = User::find($id);
        $url =$request->input('url');
        $response = auth()->user()->toggleFollow($user);

        return redirect("$url")->with('success', "Success");
    }

}
