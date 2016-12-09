<?php

namespace App\Http\Controllers;

use App\VotingLocation;
use Illuminate\Http\Request;
use App\Municipality;
use Auth;

class MunicipalityController extends Controller
{
    public function access()
    {
        $user = Auth::user();
        $municipality = $user->voting_location_id;
        return view('municipality.show')
            ->with('title', 'Municipality Page')
            ->with('municipality', VotingLocation::find($municipality));
    }

    /*public function show($municipality)
    {
        return view('pages.home')
            ->with('title', 'Municipality Page')
            ->with('municipality', Municipality::find($municipality));
    }*/
}
