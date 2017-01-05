<?php

namespace App;

use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class NewsEntry extends Model
{

    use Likeable, Eloquence;

    protected $fillable = ['title', 'description', 'image'];
    protected $searchableColumns = [
        'title',
        'description'
    ];

    /**
     * Retruns true if current users is the author of the news entry
     *
     * @return bool
     */
    public function isMine()
    {
        return $this->user_id == auth()->user()->id;
    }


    /**
     * Defines relationship with users table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
