<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|confirmed',
            'role' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
        } else {
            $imagePath = null;
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'image' => $imagePath,
            'password' => bcrypt($validated['password']),
            'role' => $validated['role']
        ]);

        return redirect()->route('dashboard.user.index')->with('success', 'User berhasil ditambahkan!');
    }


    public function update(Request $request, $user)
    {
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,user'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail($user);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/users/' . $user->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/users', $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return response()->json(['message' => 'User berhasil diperbarui!', 'user' => $user]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->image) {
            Storage::delete('public/users/' . $user->image);
        }

        $user->delete();

        return response()->json([
            'title' => 'Berhasil!',
            'message' => 'User berhasil dihapus.',
            'icon' => 'success'
        ]);
    }
}
