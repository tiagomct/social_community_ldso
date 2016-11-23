<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumLike extends Model
{
    //// just to be sure
    protected $table = 'forum_likes';

    protected $fillable = [
        'forum_id',
        'user_id',
    ];

    public function scopeForumLikesAre($query, $forum_likes)
    {
        return $query->whereIn('id', $forum_likes->pluck('id')->toArray());
    }

    public function scopeForumIs($query, $forum)
    {
        return $query->where('forum_id', $forum->id);
    }

    public function scopeUserIs($query, $user)
    {
        return $query->where('user_id', $user->id);
    }

    /**
     * Relationship to forum table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
