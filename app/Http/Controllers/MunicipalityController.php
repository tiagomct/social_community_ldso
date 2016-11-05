<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Municipality;
use Auth;

class MunicipalityController extends Controller
{
    public function access()
    {
        $user = Auth::user();
        $municipality = $user->municipality_id;
        return view('pages.home')
            ->with('title', 'Municipality Page')
            ->with('municipality', Municipality::find($municipality));
    }

    /*public function show($municipality)
    {
        return view('pages.home')
            ->with('title', 'Municipality Page')
            ->with('municipality', Municipality::find($municipality));
    }*/
}
