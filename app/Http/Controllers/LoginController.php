<?php

namespace App\Http\Controllers;

use App\Models\Solde;
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
            $this->findOrNewSolde();
            return redirect('/home');
        }

        return back()->withErrors(['login' => 'Adresse e-mail ou mot de passe incorrect'])->withInput();
    }
    public function findOrNewSolde()
    {
        $currentYear = date('Y');

        // Get the Solde for the current year or create a new one if it doesn't exist
        $solde = Solde::firstOrNew(['annee' => $currentYear]);

        // Check if the Solde is a new instance
        if (!$solde->exists) {
            // Initialize the Solde balances for the new year
            $solde->banque = 0;
            $solde->caisse = 0;
        }
        $solde->save(); // Save the changes to the database
    }




    public function gotoHome()
    {
        $this->middleware('auth');
        return view('home');
    }
}
