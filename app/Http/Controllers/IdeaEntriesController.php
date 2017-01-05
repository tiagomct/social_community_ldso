<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\IdeaEntry;
use Illuminate\Http\Request;

class IdeaEntriesController extends Controller
{

    /**
     * Directs to the view with all user Ideas requests
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $ideas = IdeaEntry::search(request()->query('search', null))
            ->with('likes')->withCount('likes');

        $ideas = $ideas->orderBy('likes_count', 'desc');

        return view('ideas.index', compact('ideas'));
    }

    /**
     * Show a selected idea and  possibly current state of the votes
     * if user did not vote, voting is enabled
     * @param IdeaEntry $idea_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($idea_id)
    {
        $ideaEntry = IdeaEntry::with(['likes', 'flags'])
            ->where('id', $idea_id)->first();

        if (!$ideaEntry) {
            redirect()->back();
        }

        $comments = $ideaEntry->comments()->with('likes')->latest()->paginate(self::DEFAULT_PAGINATION);

        return view('ideas.show', compact('ideaEntry', 'comments'));
    }

    public function create()
    {
        return view('ideas.create');
    }

    public function store(IdeaRequest $request)
    {
        $idea = new IdeaEntry();
        $idea->title = $request->title;
        $idea->description = $request->description;

        $idea->author()->associate(auth()->user());

        $idea->save();

        return redirect()->action('IdeaEntriesController@index');
    }
}
