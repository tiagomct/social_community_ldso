<?php

namespace App\Http\Controllers;

use App\Comment;
use App\ForumEntry;
use App\Http\Requests\ForumEntryRequest;
use App\Http\Requests\ForumRequest;
use Illuminate\Support\Facades\Auth;

class ForumEntriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = ForumEntry::latest()->paginate(self::DEFAULT_PAGINATION);

        return view('forum.index', compact('forums'));
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
     * @param ForumRequest|\Illuminate\Http\Request $request
     * @param ForumEntry                            $forumEntry
     * @return \Illuminate\Http\Response
     */
    public function store(ForumRequest $request, ForumEntry $forumEntry)
    {
        $forumEntry->fill($request->all());
        $forumEntry->author()->associate(auth()->user());
        $forumEntry->save();

        return redirect()->action('ForumEntriesController@index')
            ->with('success', 'Forum created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param ForumEntry $forumEntry
     * @return \Illuminate\Http\Response
     */
    public function show(ForumEntry $forumEntry)
    {
        $comments = $forumEntry->comments()->with('author')->paginate(10);
        $forumEntry->load('likes');

        return view('forum.show', compact('forumEntry', 'comments'));
    }

    public function submitEntry(ForumEntryRequest $request, ForumEntry $forumEntry)
    {
        $comment = new Comment(['description' => $request->get('description')]);
        $comment->author()->associate(auth()->user());

        $forumEntry->comments()->save(
            $comment
        );

        return redirect()->action('ForumEntriesController@show', $forumEntry->id);

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

        return redirect()->action('ForumEntriesController@show', $forum);

    }

    public function submitDislike(ForumEntry $forum)
    {
        $likes = $forum->forumLikes()->get();
        $like = ForumLike::forumLikesAre($likes)
            ->userIs(Auth::user());
        $like->delete();

        return redirect()->action('ForumEntriesController@show', $forum);

    }


    public function submitLikeEntry(ForumEntry $entry, ForumEntry $forum)
    {
        $like = new ForumLikeEntry();
        $user = Auth::user();
        $like->user()->associate($user);
        $like->forum_entry()->associate($entry);
        $like->save();

        return redirect()->action('ForumEntriesController@show', $forum);

    }
}
