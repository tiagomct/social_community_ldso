<?php

namespace App\Http\Controllers;

use App\Comment;
use App\ForumEntry;
use App\IdeaEntry;
use App\Like;
use App\MalfunctionEntry;
use App\NewsEntry;
use App\PollAnswer;
use App\Referendum;
use App\Thread;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    protected $threadBehaviourTraits = [
        'forum-entry' => ForumEntry::class,
        'idea'        => IdeaEntry::class,
        'malfunction' => MalfunctionEntry::class,
        'newsEntry'        => NewsEntry::class,
        'referendum'  => Referendum::class,
        'comment'     => Comment::class
    ];

    public function toggleLike($related, $relatedId)
    {
        $name = $this->getBehaviourModelName($related);
        if (!$name) {
            return redirect()->back();
        }

        /** @var Thread $object */
        $object = $this->getBehaviourObject($name, $relatedId);
        if (!$object) {
            return redirect()->back();
        }

        $like = $this->getMyLikeIfExists($object, $name, $relatedId);

        if ($like) {
            $like->delete();

            return redirect()->back();
        }

        // Can't vote your own posts
        if ($object->isMine()) {
            return redirect()->back();
        }

        $like = new Like();
        $like->author()->associate(auth()->user());
        $object->likes()->save($like);

        return redirect()->back();
    }

    /**
     * @param $object
     * @param $name
     * @param $relatedId
     * @return Like
     */
    private function getMyLikeIfExists($object, $name, $relatedId)
    {
        return $object->likes
            ->where('user_id', auth()->user()->id)
            ->where('likeable_type', $name)
            ->where('likeable_id', $relatedId)
            ->first();
    }
}
