<?php

namespace App\Http\Controllers;

use App\IdeaEntry;
use App\MalfunctionEntry;
use App\NewsEntry;
use App\Referendum;
use App\VotingLocation;
use Illuminate\Http\Request;
use App\Municipality;
use Auth;

class MunicipalityController extends Controller
{
    public function access()
    {
        $news = NewsEntry::with('likes')->orderBy('created_at', 'desc')->take(6)->get();
        $malfunctions= MalfunctionEntry::with('comments', 'likes')->orderBy('created_at', 'desc')->take(6)->get();
        $ideas = IdeaEntry::with('comments', 'likes')->orderBy('created_at', 'desc')->take(6)->get();
        $referendums = Referendum::with('comments', 'likes')->orderBy('created_at', 'desc')->take(6)->get();

        //dd($news, $malfunctions, $ideas, $referendums);
        return view('home', compact('news', 'malfunctions', 'ideas', 'referendums'));
    }

    /*public function show($municipality)
    {
        return view('pages.home')
            ->with('title', 'Municipality Page')
            ->with('municipality', Municipality::find($municipality));
    }*/
}
