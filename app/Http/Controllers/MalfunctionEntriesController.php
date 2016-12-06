<?php

namespace App\Http\Controllers;

use App\Http\Requests\MalfunctionRequest;
use App\Http\Requests\MalfunctionStatusChangeRequest;
use App\Like;
use App\MalfunctionEntry;
use Illuminate\Support\Facades\DB;

class MalfunctionEntriesController extends Controller
{

    /**
     * Returns list of malfunctions based on status
     * to have them sorted, lef join was needed with some raw DB queries
     * @param null $status
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($status = null)
    {
        $malfunctions = MalfunctionEntry::with('likes')->withCount('likes');

        if ($status) {
            $malfunctions->where('status', $status);
        }

        $malfunctions = $malfunctions->orderBy('likes_count', 'desc')->paginate(self::DEFAULT_PAGINATION);

        return view('malfunctions.index', compact('malfunctions'));
    }


    public function show($malfunctionId)
    {

        $malfunction = MalfunctionEntry::with('likes')
            ->where('id', $malfunctionId)
            ->first();

        if (!$malfunction) {
            return redirect()->back();
        }

        $comments = $malfunction->comments()->with('likes')->latest()->paginate(self::DEFAULT_PAGINATION);

        return view('malfunctions.show', compact('malfunction', 'comments'));
    }

    public function create()
    {
        return view('malfunctions.create');
    }

    public function store(MalfunctionRequest $request)
    {
        DB::transaction(function () use ($request) {
            $malfunction = new MalfunctionEntry();
            $malfunction->fill($request->all());
            $malfunction->status = 'pending';
            $malfunction->report = '';
            $malfunction->author()->associate(auth()->user());
            $malfunction->save();
        });

        //TODO possibly flash a message or sth like it
        return redirect()->action('MalfunctionEntriesController@index');
    }


    public function edit(MalfunctionEntry $malfunctionEntry)
    {
        return redirect()->back();
    }


    public function changeStatus(MalfunctionEntry $malfunctionEntry, MalfunctionStatusChangeRequest $request)
    {

        $malfunctionEntry->status = $request->status;
        $malfunctionEntry->report = $request->report;
        $malfunctionEntry->save();

        return redirect()->back();
    }
}
