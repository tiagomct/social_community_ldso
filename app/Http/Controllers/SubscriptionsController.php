<?php

namespace App\Http\Controllers;

use App\Comment;
use App\ForumEntry;
use App\IdeaEntry;
use App\Subscription;
use App\MalfunctionEntry;
use App\NewsEntry;
use App\PollAnswer;
use App\Referendum;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{

    protected $subscriptableModels = [
        'forum-entry' => ForumEntry::class,
        'idea'        => IdeaEntry::class,
        'malfunction' => MalfunctionEntry::class,
        'news'        => NewsEntry::class,
        'referendum'  => Referendum::class,
    ];

    public function toggleSubscription($related, $relatedId)
    {
        if (!array_has($this->subscriptableModels, $related)) {
            return redirect()->back();
        }

        $relatedModel = $this->subscriptableModels[$related];
        $subscription = $this->getMySubscriptionIfExists($relatedId, $relatedModel);

        if ($subscription) {
            $subscription->delete();

            return redirect()->back();
        }

        $model = $relatedModel::find($relatedId);

        $subscription = new Subscription();
        $subscription->author()->associate(auth()->user());
        $model->subscriptions()->save($subscription);

        return redirect()->back();
    }

    /**
     * @param      $relatedId
     * @param Subscription $subscription
     * @param      $relatedModelMethod
     * @return mixed
     */
    private function getMySubscriptionIfExists($relatedId, $relatedModel)
    {
        return Subscription::where('user_id', auth()->user()->id)
            ->where('subscriptable_type', $relatedModel)
            ->where('subscriptable_id', $relatedId)
            ->first();
    }
}
