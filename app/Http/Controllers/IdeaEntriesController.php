<?php

namespace App\Http\Controllers;

use App\IdeaEntry;
use Illuminate\Http\Request;

class IdeaEntriesController extends Controller
{
    //
    public function index()
    {
        $ideas = IdeaEntry::paginate(self::DEFAULT_PAGINATION);

        return view('ideas.index', compact('ideas'));
        //
    }

    public function show()
    {
        return redirect()->back();
    }

    public function create()
    {
        return redirect()->back();
    }
}
