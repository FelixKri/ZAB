<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

    }
    public function create()
    {

        return view('Auth.create');

    }

    public function store(Request $request)
    {

        $this->validate(request(), [

            'vorName' => 'required',
            'nachName' => 'required',
            'klasse' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'

        ]);


        $user = User::create([

            'vorName' => request('vorName'),

            'nachName' => request('nachName'),

            'email' => request('email'),

            'password' => bcrypt(request('password')),

            'isAdmin' => true,

            'canWrite' => true,

            'klasse_id' => 3,
        ]);

        auth()->login($user);

        return redirect('/');

    }
}
