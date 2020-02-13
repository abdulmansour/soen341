@extends('layouts.app')

@section('content')
    <div class="card" style="width: 40rem">
        <div class="card-header">
            <h3 class="card-title">
                {{$post->title}}
                @if ($post->user_id == Auth::user()->id)
                    <a href="/soen341/public/posts/{{$post->id}}/edit"><button  class="btn btn-default" style="float: right;">Edit</button></a>
                @endif
            </h3>
        </div>
        <div class="card-body">
            <img class="card-img-top" src="/soen341/storage/app/public/images/{{$post->image}}">
            <p class="card-text">{{$post->body}}</p>
        </div>
        <footer class="blockquote-footer">Written by {{$post->user->name}} on {{$post->created_at}}</footer>
    </div>
@endsection