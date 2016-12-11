<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Flag;
use App\ForumEntry;
use App\IdeaEntry;
use App\MalfunctionEntry;
use App\NewsEntry;
use App\Referendum;
use App\Thread;

class FlagsController extends Controller
{

    protected $threadBehaviourTraits = [
        'forum-entry' => ForumEntry::class,
        'idea'        => IdeaEntry::class,
        'malfunction' => MalfunctionEntry::class,
        //'news'        => NewsEntry::class,
        'referendum'  => Referendum::class,
        'comment'     => Comment::class
    ];

    public function toggleFlag($related, $relatedId)
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

        $flag = $this->getMyFlagIfExists($object, $name, $relatedId);

        if ($flag) {
            $flag->delete();

            return redirect()->back();
        }

        $flag = new Flag();
        $flag->author()->associate(auth()->user());
        $object->flags()->save($flag);

        return redirect()->back();
    }

    /**
     * @param $object
     * @param $name
     * @param $relatedId
     * @return Flag
     */
    private function getMyFlagIfExists($object, $name, $relatedId)
    {
        return $object->flags
            ->where('user_id', auth()->user()->id)
            ->where('flagable_type', $name)
            ->where('flagable_id', $relatedId)
            ->first();
    }
}
