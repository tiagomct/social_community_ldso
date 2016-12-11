<?php

namespace App\Http\Controllers;

use App\EntryFollow;
use Illuminate\Http\Request;

class FeedsController extends Controller
{

    public function subscriptions()
    {
        $follows = EntryFollow::mine()
            ->with('entry')
            ->orderBy('created_at')
            ->paginate(Controller::DEFAULT_PAGINATION);

        return view('feeds.subscriptions', compact('follows'));
    }
}
