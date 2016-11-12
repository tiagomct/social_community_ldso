<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{

    protected $table = 'municipality';
    //
    protected $fillable = [
        'name',
    ];
}
