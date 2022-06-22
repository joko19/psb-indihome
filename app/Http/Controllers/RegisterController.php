<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    //
    public function viewRegister(Request $request)
    {
        return view('auth.register');
    }


    public function postRegister(Request $request)
    {
        // dd($request->all());
        User::create([
            'name' => $request->name,
            'level' => 'teknisi',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60)
        ]);
        return view('auth.login');
    }
}
