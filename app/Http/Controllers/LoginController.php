<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('gotoHome');
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        if ($user && !Hash::check($password, $user->password)) {
            $errors = [
                'password' => 'Mot de passe invalide'
            ];
            return back()->withErrors($errors)->withInput();
        }

        if ($user && !$user->approved) {
            $errors = [
                'email' => "Votre compte n'a pas encore été approuvé."
            ];
            return back()->withErrors($errors)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            return redirect('/home');
        }

        return back()->withErrors(['login' => 'Adresse e-mail ou mot de passe incorrect'])->withInput();
    }





    public function gotoHome()
    {
        $this->middleware('auth');
        return view('home');
    }
}
