<?php

namespace App\Services;


use App\ForumEntry;
use App\NewsEntry;
use App\Referendum;

class GetLatestPostsFooter
{
    public function referendums()
    {
        return Referendum::orderBy('created_at', 'desc')->take(5)->get();
    }

    public function forumThreads()
    {
        return ForumEntry::orderBy('created_at', 'desc')->take(5)->get();
    }

    public function news()
    {
        return NewsEntry::orderBy('created_at', 'desc')->take(5)->get();
    }
}