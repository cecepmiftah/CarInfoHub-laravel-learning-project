<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SignupController extends Controller
{
    public function create()
    {
        return view('auth.signup');
    }

    public function store(Request $request) 
    {

        
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'string', 'unique:users,email'],
            'password' => ['required', Password::min(6), 'confirmed'],
            'phone' => ['required', 'min:10', 'numeric'],
        ]);


        $user = User::create($validated);

        Auth::login($user); 

        return redirect('/');
    }
}
