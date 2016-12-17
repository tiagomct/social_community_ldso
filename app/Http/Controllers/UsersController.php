<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\User;
use Auth;
use Validator;
use File;
use Image;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->select('id', 'name', 'politics', 'img_name', 'interests')->orderBy('name')->paginate(10);

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        if(auth()->user()->id != $user->id){
            return redirect()->back();
        }

        //TODO get last activity from user
        $news = User::where('id', 3000)->get();
        $referendums = User::where('id', 3000)->get();
        $forumThreads = User::where('id', 3000)->get();
        $malfunctions = User::where('id', 3000)->get();

        return view('users.show', compact('user', 'news', 'forumThreads', 'malfunctions', 'referendums'));
    }

    public function edit(User $user)
    {
        if(auth()->user()->id != $user->id){
            return redirect()->back();
        }
        return view('users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {

        if(auth()->user()->id != $user->id){
            return redirect()->back();
        }

        if ($request->file('img')) {

            $file = $request->file('img');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->save(public_path('images/users/' . $filename));

            if ($user->img_name != 'default.jpg') {
                File::delete(public_path('images/users/' . $user->img_name));
            }
            $user->img_name = $filename;
        }

        if ($request->description) {
            $user->description = $request->description;
        }
        if ($request->politics) {
            $user->politics = $request->politics;
        }
        if ($request->interests) {
            $user->interests = $request->interests;
        }
        if ($request->email) {
            $user->email = $request->email;
        }

        $user->save();
        return redirect()->action('UsersController@show', $user);
    }


}
