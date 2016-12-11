<?php

namespace App\Http\Controllers;

use App\EntryFollow;
use App\Thread;

class FollowsController extends Controller
{

    public function toggleFollow($related, $relatedId)
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

        $follow = $this->getMyFollowIfExists($object, $name, $relatedId);

        if ($follow) {
            $follow->delete();

            return redirect()->back();
        }

        $follow = new EntryFollow();
        $follow->author()->associate(auth()->user());
        $object->follows()->save($follow);

        return redirect()->back();
    }

    /**
     * @param $object
     * @param $name
     * @param $relatedId
     * @return EntryFollow
     */
    private function getMyFollowIfExists($object, $name, $relatedId)
    {
        return $object->follows
            ->where('user_id', auth()->user()->id)
            ->where('entry_followable_type', $name)
            ->where('entry_followable_id', $relatedId)
            ->first();
    }
}
