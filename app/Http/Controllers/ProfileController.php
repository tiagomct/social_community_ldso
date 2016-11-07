<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function list(User $user)
    {
        $users = User::where('id', '!=', $user->id)->select('id', 'name', 'politics', 'img_name', 'interests')->orderBy('name')->paginate(10);

        return view('profile.browse', compact('users'));
    }
}
