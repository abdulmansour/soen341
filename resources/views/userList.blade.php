@if($users->count())
    @foreach($users as $user)
        <div class="col-2 profile-box border p-1 rounded text-center bg-light mr-4 mt-3">
            <img src="http://i-sip.encs.concordia.ca/s3pcps2016/assets/img/partner-logos/Con_Logo1.jpg" style="height: 50px; width: 50px; border-radius: 50%;" class="img-responsive">
            <h5 class="m-0"><a href="{{ route('user.view', $user->id) }}"><strong>{{ $user->name }}</strong></a></h5>
            <p class="mb-2">
                <small>Following: <span class="badge badge-primary">{{ $user->followings()->get()->count() }}</span></small>
                <small>Followers: <span class="badge badge-primary tl-follower">{{ $user->followers()->get()->count() }}</span></small>
            </p>
     <form method="POST" action="{{ route('followToggle') }}">
        <div class="form-group">
            @csrf            
            <input name="id" type="hidden" class="form-control" value="{{$user->id}}"/>
        </div>
        <div class="form-group">
            @csrf            
            <input name="url" type="hidden" class="form-control" value="{{Request::url()}}"/>
        </div>        

        <button type="submit" class="btn btn-primary">
        @if(auth()->user()->isFollowing($user))
                UnFollow
            @else
                Follow
        @endif   
        </button>
    </form>
         



        </div>
    @endforeach
@endif 