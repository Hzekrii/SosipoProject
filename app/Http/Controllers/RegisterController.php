<?php

namespace App\Http\Controllers;

use App\Models\{User, Role};
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**

     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        $data = [
            'title' => 'Inscription  - ' . config('app.name'),
            'description' => 'l\'inscription dans ce site sur ' . config('app.name'),
            'roles' => $roles,
        ];
        return view('auth.register', $data);
    }

    public function register(Request $request)
    {
        request()->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User;
        $user->name = request('name');
        $user->email = request('email');
        $user->role_id = request('role');
        $user->password = bcrypt(request('password'));
        $avatar = request('avatar');
        $url1 = $avatar->store('public/images');
        $url = str_replace("public/images", "", $url1);
        $user->url = $url;
        $user->save();
        $success = "Inscription términé avec succes.";
        return back()->withSuccess($success);
    }
}
