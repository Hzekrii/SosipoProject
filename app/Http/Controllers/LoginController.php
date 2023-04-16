<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('gotoHome');
    }

    public function check(Request $request)
    {

        request()->validate([
            'email' => 'required|min:3',
            'password' => 'required'
        ]);
        $remember = request()->has('remember');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

            return redirect('/home');
        }
        return  back()->withError('veuillez  vérifié votre informations')->withInput();
    }
    public function gotoHome()
    {
        $this->middleware('auth');
        return view('home');
    }


}
