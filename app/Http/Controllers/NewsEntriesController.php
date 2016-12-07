<?php

namespace app\Http\Controllers;

//use App\Http\Requests\MalfunctionRequest;
//use App\Http\Requests\MalfunctionStatusChangeRequest;
//use App\Like;
use App\NewsEntry;
use Illuminate\Support\Facades\DB;

class NewsEntriesController
{
    /**
     * Directs to the view with all news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $news = NewsEntry::all()->where('archived','==','0');

        return view('news.index', compact('news'));
    }

    public function create() {
        return redirect()->back();
    }
}