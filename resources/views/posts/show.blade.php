@extends('layouts.app')

@section('content')
    <h1>{{$post->title}}</h1>
    <p>{{$post->body}}</p>
    <small>{{$post->created_at}}</small>
@endsection