<?php

namespace App\Http\Controllers;

use App\Forum;
use App\ForumEntry;
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
        $forums = Forum::paginate(self::DEFAULT_PAGINATION);

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
        Forum::create($request->all());
        return redirect()->action('ForumsController@index')
            ->with('success','Forum created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        $entries = $forum->forumEntries()->paginate(10);
        return view('forum.show', compact('forum','entries'));
    }

    public function submitEntry(ForumEntryRequest $request, Forum $forum)
    {
        $entry = new ForumEntry();
        $user = Auth::user();
        $entry->user()->associate($user);
        $entry->forum()->associate($forum);
        $entry->content=$request->get('content');
        $entry->save();

        return redirect()->action('ForumsController@show', $forum);

    }
}
