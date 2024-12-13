<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $attributes['email'])->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => 'The email address is not registered.',
            ]);
        }

        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'password' => 'The password you entered is incorrect.',
            ]);
        }

        request()->session()->regenerate();

        return redirect('/');
    }
    function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
