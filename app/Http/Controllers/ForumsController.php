<?php

namespace App\Http\Controllers;

use App\ForumEntry;
use App\ForumEntry;
use App\ForumLike;
use App\ForumEntryLike;
use App\Http\Requests\ForumEntryRequest;
use App\Http\Requests\ForumRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = ForumEntry::paginate(self::DEFAULT_PAGINATION);

        return view('forum.index', compact('forums'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumRequest $request)
    {
        ForumEntry::create($request->all());
        return redirect()->action('ForumsController@index')
            ->with('success','Forum created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ForumEntry $forum)
    {
        $entries = $forum->forumEntries()->paginate(10);
        $likes = $forum->forumLikes()->get();
        $userLikeId = ForumLike::forumLikesAre($likes)
            ->userIs(Auth::user())
            ->value('id');

        /*$forum_entries = $forum->forumEntries()->get();
        $userentryLikeId = ForumEntryLike::forumEntryLikesAre($forum_entries)
            ->userIs(Auth::user())
            ->value('id');*/

        $totalLikes = $this->totalLikesOfForum($likes);
        //$totalEntryLikes = $this->totalLikesOfForum($entries_likes);

        return view('forum.show', compact('forum','entries', 'userLikeId', 'userentryLikeId', 'totalLikes'));
    }

    public function submitEntry(ForumEntryRequest $request, ForumEntry $forum)
    {
        $entry = new ForumEntry();
        $user = Auth::user();
        $entry->user()->associate($user);
        $entry->forum()->associate($forum);
        $entry->content=$request->get('content');
        $entry->save();

        return redirect()->action('ForumsController@show', $forum);

    }

    /**
     * @param ForumEntry $forum
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitLike(ForumEntry $forum)
    {
        $like = new ForumLike();
        $user = Auth::user();
        $like->user()->associate($user);
        $like->forum()->associate($forum);
        $like->save();

        return redirect()->action('ForumsController@show', $forum);

    }

    public function submitDeslike(ForumEntry $forum)
    {
        $likes = $forum->forumLikes()->get();
        $like = ForumLike::forumLikesAre($likes)
            ->userIs(Auth::user());
        $like->delete();

        return redirect()->action('ForumsController@show', $forum);

    }


    public function submitLikeEntry(ForumEntry $entry, ForumEntry $forum)
    {
        $like = new ForumLikeEntry();
        $user = Auth::user();
        $like->user()->associate($user);
        $like->forum_entry()->associate($entry);
        $like->save();

        return redirect()->action('ForumsController@show', $forum);

    }

    /*public function submitDeslikeEntry(ForumEntry $entry, Forum $forum)
    {
        $likes = $entry->entryLikes()->get();
        $like = ForumEntryLike::entryLikesAre($likes)
            ->userIs(Auth::user());
        $like->delete();

        return redirect()->action('ForumsController@show', $forum);

    }*/


    private function totalLikesOfForum($likes) {
        $total = 0;

        foreach ($likes as $like) {
            $total += 1;
        }

        return $total;
    }
}
