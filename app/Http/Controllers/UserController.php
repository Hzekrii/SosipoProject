<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function profile()
    {
        return view('user.profile');
    }
    public function edit()
    {
        $user = Auth::user();
        $roles = Role::get();
        return view('user.edit', compact('user', 'roles'));
    }
    public function update(Request $request)
    {
        $oldPassword = $request->input('oldPassword');
        if (Hash::check($oldPassword, auth()->user()->password)) {
            $validatedData = $request->validate([
                'name' => 'required|min:5',
                'email' => 'required|email',
                'role_id' => 'required|exists:roles,id',
                'password' => 'required|confirmed',
            ]);

            $user = User::find(auth()->user()->id);
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->role_id = $validatedData['role_id'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            return redirect('/profile')->with('success', 'Votre profil a été modifié avec succès');
        }

        return redirect('/user/edit')->with('error', 'Votre mot de passe n\'est pas correct');
    }
}
