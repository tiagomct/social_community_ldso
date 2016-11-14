<?php

namespace App\Http\Controllers;

use App\Forum;
use App\ForumEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::paginate(self::DEFAULT_PAGINATION);

        return view('forum.index', compact('forums'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function create()
    {
        return view('forum.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        Forum::create($request->all());
        return redirect()->route('forum')
            ->with('success','Forum created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        $entries = $forum->forumEntries()->get();
        return view('forum.show', compact('forum','entries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function submitEntry(Request $request, $id)
    {
        $entry = new ForumEntry();
        $forum = Forum::find($id);
        $user = Auth::user();
        printf($user);
        $this->validate($request, [
            'content' => 'required',
        ]);
        $entry->user()->associate($user);
        $entry->forum()->associate($forum);
        $entry->content=$request->get('content');
        $entry->save();

        return redirect()->action('ForumController@show', $forum);

    }
}
