<?php

namespace App;

use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Likeable;

    protected $fillable = [
        'description',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isMine()
    {
        return $this->user_id == auth()->user()->id;
    }
}
