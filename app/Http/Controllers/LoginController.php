<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    //
    //
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('dashboard');
        }
        Alert::alert('Kesalahan', 'Email atau Password Salah ', 'error');
        return redirect("login");
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}
