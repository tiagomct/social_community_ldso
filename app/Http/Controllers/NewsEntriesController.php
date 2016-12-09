<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
//use App\Http\Requests\MalfunctionStatusChangeRequest;
use App\NewsEntry;
use Illuminate\Support\Facades\DB;

class NewsEntriesController extends Controller
{
    /**
     * Directs to the view with all news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $news = NewsEntry::all()->where('archived','==','0')->sortByDesc('updated_at');
        return view('news.index', compact('news'));

    }

    public function show($newsEntry)
    {
        $new = NewsEntry::all()->where('id', $newsEntry)->first();

        if (!$new) {
            return redirect()->back();
        }

        return view('news.show', compact('new'));
    }

    public function create() {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsRequest|\Illuminate\Http\Request $request
     * @param NewsEntry                            $newsEntry
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request, NewsEntry $newsEntry)
    {
        $newsEntry->fill($request->all());
        $newsEntry->author()->associate(auth()->user());
        $newsEntry->save();

        return redirect()->action('NewsEntriesController@index')
            ->with('success', 'News story created successfully');
    }

}