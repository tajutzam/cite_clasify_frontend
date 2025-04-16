<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('login');
    }

    public function handleLoginGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleLoginGoogleCalback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first();
        if (!$user) {
            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => Hash::make(rand(100000, 999999)), 'image' => $googleUser->getAvatar(), 'is_google_account' => true]);
        }
        Auth::login($user);
        return redirect()->route('dashboard.index')->with('success', 'login berhasil');
    }
}
