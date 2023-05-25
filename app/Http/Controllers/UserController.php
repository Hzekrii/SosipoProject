<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isNull;

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
        $user = User::find(auth()->id());

        if (Hash::check($oldPassword, $user->password) && $request->filled('password')) {
            $validatedData = $request->validate([
                'name' => 'required|min:5',
                'email' => 'required|email',
                'password' => 'required|confirmed',
            ]);

            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);
        } else {
            $validatedData = $request->validate([
                'name' => 'required|min:5',
                'email' => 'required|email',
            ]);

            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);
        }

        if (isset($validatedData['password'])) {
            return redirect('/profile')->with('success', 'Votre profil a été modifié avec succès');
        } else {
            return redirect('/user/edit')->with('error', 'Votre mot de passe n\'est pas correct');
        }
    }
}
