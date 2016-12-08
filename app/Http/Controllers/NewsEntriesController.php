<?php

namespace App\Http\Controllers;

//use App\Http\Requests\MalfunctionRequest;
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
        $news = NewsEntry::all()->where('archived','==','0')->sortBy('updated_at');
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
        return redirect()->back();
    }
}