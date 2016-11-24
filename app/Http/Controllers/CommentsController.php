<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;

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

        return redirect()->back();
    }

}
