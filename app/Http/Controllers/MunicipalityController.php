<?php

namespace App\Http\Controllers;

use App\NewsEntry;
use App\VotingLocation;
use Illuminate\Http\Request;
use App\Municipality;
use Auth;

class MunicipalityController extends Controller
{
    public function access()
    {
        $user = Auth::user();
        $municipality = $user->votingLocation;
        $newsEntries = NewsEntry::search(request()->query('search', null))->paginate(Controller::DEFAULT_PAGINATION);

        return view('home')
            ->with('municipality', $municipality)
            ->with('newsEntries', $newsEntries);
    }

    /*public function show($municipality)
    {
        return view('pages.home')
            ->with('title', 'Municipality Page')
            ->with('municipality', Municipality::find($municipality));
    }*/
}
