<?php

namespace App\Http\Controllers;

use App\Http\Requests\MalfunctionRequest;
use App\Http\Requests\MalfunctionStatusChangeRequest;
use App\Like;
use App\MalfunctionEntry;
use Illuminate\Support\Facades\DB;
use Image;

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
        $malfunctions = MalfunctionEntry::search(request()->query('search', null));

        if ($status) {
            $malfunctions->where('status', $status);
        }

        $malfunctions = $malfunctions->with('likes')->withCount('likes')
            ->orderBy('status', 'desc')->orderBy('created_at', 'desc')->paginate(self::DEFAULT_PAGINATION);

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
            $malfunction->fill([
                'title'       => $request->title,
                'description' => $request->description
            ]);
            $malfunction->status = 'pending';
            $malfunction->report = '';
            $malfunction->author()->associate(auth()->user());

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                Image::make($file)->save(public_path('images/malfunctions/' . $filename));
                $malfunction->image = $filename;
            }

            $malfunction->save();
        });

        //TODO possibly flash a message or sth like it
        return redirect()->action('MalfunctionEntriesController@index');
    }


    public function edit(MalfunctionEntry $malfunctionEntry)
    {
        return view('malfunctions.edit', compact('malfunctionEntry'));
    }


    public function update(MalfunctionEntry $malfunctionEntry, MalfunctionStatusChangeRequest $request)
    {

        $malfunctionEntry->status = $request->status;
        $malfunctionEntry->report = $request->report;
        $malfunctionEntry->save();

        return redirect()->action('MalfunctionEntriesController@show', $malfunctionEntry->id);
    }
}
