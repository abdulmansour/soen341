@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
        @if (count($posts) > 0)
            <div class="container">
                @foreach ($posts as $post)
                    <div class="row">
                        <div class="col">
                            <div class="card" style="width: 40rem">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <a href="/soen341/public/posts/{{$post->id}}">
                                            {{$post->title}}
                                        </a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <a href="/soen341/public/posts/{{$post->id}}">
                                        <img class="card-img-top" src="/soen341/storage/app/public/images/{{$post->image}}">
                                    </a>
                                    <p class="card-text">{{$post->body}}</p>
                                </div>
                                <footer class="blockquote-footer">Written by {{$post->user->name}} on {{$post->created_at}}</footer>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="width: 25rem">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        {{$post->ad_search_word}}
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <a href="#">
                                        <!--<img class="card-img-top" src="/soen341/storage/app/public/images/ad.png"> -->
                                        <?php
                                            $image = $post->ad_image_url;
                                            $imageData = base64_encode(file_get_contents($image));
                                            echo '<img class="card-img-top" src="data:image/jpeg;base64,'.$imageData.'">';
                                        ?>
                                    </a>
                                    <p class="card-text"></p>
                                </div>
                                <footer class="blockquote-footer">{{$post->ad_description}}</footer>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$posts->links()}}
        @else 
            <p>No posts found!</p>
        @endif
    <a style="margin-top:15px" class="btn btn-primary" href="{{ route('posts.create') }}">Create Post</a>
@endsection