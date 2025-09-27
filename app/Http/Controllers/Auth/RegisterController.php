<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        return inertia('Auth/Register');
    }

    public function store(Request $request)
    {
        //Validate
        $credentials = $request->validate([
            'full_name'=> ['required', 'min:3', 'max:150'],
            'email' => ['email', 'required', 'max:250'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required']
        ]);
        //Create
        $user = User::create($credentials);

        //Send Verification
        event(new Registered($user));

        //login
        Auth::login($user);
        //Redirect
        return redirect()->route('verification.notice');
    }


}
