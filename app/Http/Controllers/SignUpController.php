<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function index()
    {
        return view('register.index')
            ->with('title', 'Sign Up');
    }

    public function signup(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|unique:users',
            'display_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:32',
            'confirm-password' => 'required|min:8|max:32',
        ]);

        if ($credentials['password'] !== $credentials['confirm-password']) {
            return back()->with('signupError', "your password and password confirmation doesn't match");
        }

        unset($credentials['confirm-password']);
        $credentials['password'] = bcrypt($credentials['password']);
        User::create($credentials);

        return redirect('/signin')->with('signupSuccess', 'your account successfully created');
    }
}
