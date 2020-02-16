<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;
use Overtrue\LaravelFollow\Traits\CanBeLiked;

class Post extends Model
{
	use Commentable, CanBeLiked;
}
