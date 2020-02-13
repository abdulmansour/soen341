@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <form method="POST" action="{{ route('posts.store') }}">
        <div class="form-group">
            @csrf            
            <label for="title">Title</label>
            <input name="title" type="text" class="form-control" placeholder="Title"/>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" class="form-control" cols="30" rows="10" placeholder="Body Text"></textarea>
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input name = "image" type="file" class="custom-file-input">
                <label class="custom-file-label">Choose File</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
 </form>
@endsection