@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <div>
        @if (count($posts) > 0) 
            @foreach ($posts as $post)
                <div class="card">
                <h3><a href="/soen341/public/posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <small>Written on {{$post->created_at}}</small>
                </div>
            @endforeach
            {{$posts->links()}}
        @else 
            <p>No posts found!</p>
        @endif
    </div>
    <a style="margin-top:15px" class="btn btn-primary" href="{{ route('posts.create') }}">Create Post</a>
@endsection