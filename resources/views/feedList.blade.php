    @if (count($posts) > 0) 
    @foreach ($posts as $post)
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
    @endforeach
    @else 
        <p>No posts found!</p>
    @endif
