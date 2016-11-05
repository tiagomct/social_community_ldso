<?php

namespace App\Http\Controllers;

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

    public function update(Request $request)
    {
        if ($request->isMethod('get')) {
            $user = Auth::user();
            return view('profile.edit', compact('user'));
        } elseif ($request->isMethod('post')) {

            $user = Auth::user();

            $validator = Validator::make($request->all(), $user->rules_on_update($user));

            if ($validator->fails()) {
                return redirect('/user/edit')
                    ->withErrors($validator)
                    ->withInput();
            }

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
            return redirect('/profile/' . $user->id);
        }
    }


}
