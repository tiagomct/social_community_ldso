<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Commentable;
use App\Traits\Likeable;

abstract class Thread extends Model
{
    use Commentable, Likeable;
}
