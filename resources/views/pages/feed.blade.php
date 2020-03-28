@extends('layouts.app')

@section('content')
<h1>Feed</h1>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row pl-5">
                    @include('feedList', ['posts'=>$posts])
                </div>
            </div>
        </div>
    </div>
</div>


@endsection