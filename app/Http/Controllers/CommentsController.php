<?php

namespace App\Http\Controllers;

use App\Subscription;
use Auth;
use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Notifications\ThreadNotification;

class CommentsController extends Controller
{

    public function store(CommentRequest $request, $related, $relatedId)
    {
        $name = $this->getBehaviourModelName($related);
        if (!$name) {
            return redirect()->back();
        }

        $object = $this->getBehaviourObject($name, $relatedId);
        if(!$object) {
            return redirect()->back();
        }

        $comment = new Comment($request->all());
        $comment->author()->associate(auth()->user()->id);
        $object->comments()->save($comment);

        $userIds = Subscription::where('subscriptable_type', $related)->where('subscriptable_id', $relatedId)->pluck('user_id');
        foreach ($userIds as $userId){
            $user=User::where('id', $userId)->get();
            $user->notify(new ThreadNotification($comment));
        }
        Auth::user()->notify(new ThreadNotification($comment));

        return redirect()->back();
    }

}
