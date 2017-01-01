<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Role;
use App\User;
use Auth;
use Validator;
use File;
use Image;

use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Lists all users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::search(request()->query('search', null))
            ->paginate(self::DEFAULT_PAGINATION);

        return view('users.index', compact('users'));
    }


    /**
     * Shows a single user profile
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {

        //TODO get last activity from user
        $ideas = User::where('id', 3000)->get();
        $referendums = User::where('id', 3000)->get();
        $forumThreads = User::where('id', 3000)->get();
        $malfunctions = User::where('id', 3000)->get();

        return view('users.show', compact('user', 'ideas', 'forumThreads', 'malfunctions', 'referendums'));
    }


    /**
     * Shows edit form for authenticated user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = auth()->user();

        return view('users.edit', compact('user'));
    }


    /**
     * Updates information on authenticated user profile
     *
     * @param UserUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request)
    {

        $user = auth()->user();

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


    /**
     * Shows Moderator section
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function moderatorSection(){
        return view('users.moderatorSection');
    }


    /**
     * Function toggles Moderator access for a user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleModerator(User $user)
    {
        if($user->isModerator() and !$user->isAdministrator()){
            $user->role()->associate(Role::where('title', 'User')->first());
        }elseif ($user->isUser()){
            $user->role()->associate(Role::where('title', 'Moderator')->first());
        }

        $user->save();

        return redirect()->back();
    }


}
