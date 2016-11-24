<?php

namespace App\Http\Controllers;

use App\Comment;
use App\ForumEntry;
use App\IdeaEntry;
use App\Like;
use App\MalfunctionEntry;
use App\NewsEntry;
use App\Referendum;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    protected $likeableModels = [
        'forum-entry' => ForumEntry::class,
        'idea'        => IdeaEntry::class,
        'malfunction' => MalfunctionEntry::class,
        'news'        => NewsEntry::class,
        'referendum'  => Referendum::class,
        'comment'     => Comment::class
    ];

    public function toggleLike($related, $relatedId)
    {
        if (!array_has($this->likeableModels, $related)) {
            return redirect()->back();
        }

        $relatedModel = $this->likeableModels[$related];
        $like = $this->getMyLikeIfExists($relatedId, $relatedModel);

        if ($like) {
            $like->delete();

            return redirect()->back();
        }

        $model = $relatedModel::find($relatedId);
        // Can't vote your own posts
        if($model->isMine()) {
            return redirect()->back();
        }

        $like = new Like();
        $like->author()->associate(auth()->user());
        $model->likes()->save($like);

        return redirect()->back();
    }

    /**
     * @param      $relatedId
     * @param Like $like
     * @param      $relatedModelMethod
     * @return mixed
     */
    private function getMyLikeIfExists($relatedId, $relatedModel)
    {
        return Like::where('user_id', auth()->user()->id)
            ->where('likeable_type', $relatedModel)
            ->where('likeable_id', $relatedId)
            ->first();
    }
}
