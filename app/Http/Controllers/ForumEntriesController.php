<?php

namespace App\Http\Controllers;

use App\ForumEntry;
use App\Http\Requests\ForumRequest;

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
        $comments = $forumEntry->comments()->with('author')->paginate(self::DEFAULT_PAGINATION);
        $forumEntry->load('likes');

        return view('forum.show', compact('forumEntry', 'comments'));
    }

}
