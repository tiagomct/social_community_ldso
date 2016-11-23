<?php

namespace App\Http\Controllers\Auth;

use App\Role;
use App\User;
use App\VotingLocation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'       => 'required|max:255',
            'email'      => 'required|email|max:255|unique:users,email',
            'id_card'    => 'required|max:255|unique:users,id_card',
            'birth_date' => 'required|max:255|date_format:Ymd',
            'password'   => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = DB::transaction(function () use ($data) {
            $user = new User([
                'name'       => $data['name'],
                'email'      => $data['email'],
                'id_card'    => $data['id_card'],
                'birth_date' => Carbon::createFromFormat('Ymd', $data['birth_date']),
                'password'   => bcrypt($data['password']),
                'description' => '',
                'politics' => '',
                'interests' => '',
            ]);

            $votingLocation = VotingLocation::fromUser($user);

            $user->votingLocation()->associate($votingLocation);
            $user->role()->associate(Role::where('title', 'User')->first());
            $user->save();

            return $user;
        });

        return $user;

    }
}
