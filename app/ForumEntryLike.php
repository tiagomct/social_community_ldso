<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumEntryLike extends Model
{
    //
    public function scopeEntryLikesAre($query, $entry_likes)
    {
        return $query->whereIn('id', $entry_likes->pluck('id')->toArray());
    }

    public function scopeForumIs($query, $forum_entry)
    {
        return $query->where('forum_entry_id', $forum_entry->id);
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
        return $this->belongsTo(ForumEntry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
