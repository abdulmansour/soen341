<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderby('created_at', 'desc')->paginate(10);
        foreach($posts as $post) {
            $user = User::find($post->user_id);
            $post->user = $user;
        }
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required' ,
            'body'=>'required',
            'image' => 'image|required|max:1999'
        ]);

        //if no errors => Create Post
        $user = Auth::user();
        if (is_null($user)) {
            //if user is not logged in, redirect the user to the login page
            return redirect('login/')->with('error', 'Login Required');
        }
        
        //Create post
        $post = new Post;
        $post->user_id = $user->id;
        $post->title = $request->input('title');
        $post->body = $request->input('body'); 
        
        //Handle image storage
        $filenameWithExt = $request->file('image')->getClientOriginalName();
        //filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //ext
        $ext = $request->file('image')->getClientOriginalExtension();
        //to make file unique => add the current timestamp
        $filenameToStore = $filename.'_'.time().'.'.$ext;
        $post->image = $filenameToStore;
        //save
        $post->save();

        //upload image in 'public/images' folder
        $path = $request->file('image')->storeAs('public/images', $filenameToStore);

    
        return redirect('posts/')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $user = User::find($post->user_id);
        $post->user = $user;
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
