<?php

namespace App;

use App\Traits\Followable;
use App\Traits\Reportable;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Commentable;
use App\Traits\Likeable;

abstract class Thread extends Model
{
    use Commentable, Likeable, Reportable, Followable;
}
