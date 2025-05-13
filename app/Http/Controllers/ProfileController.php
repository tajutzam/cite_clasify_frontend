<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        return view('dashboard.profile.index', compact('user'));
    }


    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Menghindari error saat mengupdate email yang sama
            'password' => 'nullable|string|min:8|confirmed', // Pastikan password lebih dari 8 karakter jika diisi
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Update foto profil jika ada
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete($user->image);
            }

            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = "/storage" . "/" . $path;
        }

        $user->save();

        return redirect()->route('dashboard.index')->with('success', 'Profile updated successfully!');
    }

}
