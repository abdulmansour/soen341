@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Feed from users you are following:</div>


                <div class="card-body">
                    <div class="row pl-5">
                        @include('feedList', ['posts'=>$posts])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection