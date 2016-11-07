<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\User;
use Auth;
use Validator;
use File;
use Image;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {

        if ($request->file('img')) {

            $file = $request->file('img');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            Image::make($file)->save(public_path('/storage/uploads/users/' . $filename));

            if ($user->img_name != 'default.jpg') {
                File::delete(public_path('/storage/uploads/users/' . $user->img_name));
            }
            $user->img_name = $filename;
        }

        if ($request->description) {
            $user->description = $request->description;
        } else {
            $user->description = '';
        }
        if ($request->politics) {
            $user->politics = $request->politics;
        } else {
            $user->politics = '';
        }
        if ($request->interests) {
            $user->interests = $request->interests;
        } else {
            $user->interests = '';
        }
        if ($request->email) {
            $user->email = $request->email;
        } else {
            $user->email = '';
        }

        $user->save();
        return redirect()->action('ProfileController@show', $user);
    }


}
