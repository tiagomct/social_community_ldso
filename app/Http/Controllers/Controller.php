<?php

namespace App\Http\Controllers;

use App\ForumEntry;
use App\IdeaEntry;
use App\MalfunctionEntry;
use App\NewsEntry;
use App\Referendum;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const DEFAULT_PAGINATION = 20;
    protected $threadBehaviourTraits = [
        'forum-entry' => ForumEntry::class,
        'idea'        => IdeaEntry::class,
        'malfunction' => MalfunctionEntry::class,
        // 'news'        => NewsEntry::class,
        'referendum'  => Referendum::class
    ];

    protected function getBehaviourModelName($related)
    {
        if (!array_has($this->threadBehaviourTraits, $related)) {
            return null;
        }

        return $this->threadBehaviourTraits[$related];
    }

    protected function getBehaviourObject($name, $relatedId)
    {
        return $name::find($relatedId);
    }
}
