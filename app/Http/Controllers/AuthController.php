<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function showMovies() {
        $ongoing = Movie::with('genre')->where('status', 'ongoing')->get();
        $upcoming = Movie::with('genre')->where('status', 'upcoming')->get();

        return view('home', compact('ongoing', 'upcoming'));
    }

    function login() {
        return view('login');
    }
    
    function postLogin(Request $requset) {
        $lgn = $requset->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt($lgn)){
            $user = Auth::user();
            Log::create([
                'activity' => $user->username. 'Telah login ',
                'user_id' => $user->id
            ]);
            if($user->role == 'admin'){
                return redirect()->route('homeAdmin')->with('message', 'Login Berhasil, Selamat Datang '. $user->name);
            } elseif($user->role == 'owner'){
                return redirect()->route('homeOwner')->with('message', 'Login Berhasil, Selamat Datang '. $user->name);
            } else{
                return redirect()->route('showMovies')->with('message', 'Login Berhasil, Selamat Datang '. $user->name);
            }
        } else {
            return redirect()->route('login')->with('message', 'Username atau Password Salah');
        }
    }
    function logout() {
        if(Auth::check()){
            Auth::logout();
            return redirect()->route('showMovies')->with('message', 'Logout Berhasil');
        }
    }
    function daftar() {
        return view('daftar');
    }
    function postdaftar(Request $request) {
        $user = $request->validate([
            'name' =>'required',
            'username' =>'required',
            'password' => 'required',
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'kasir',
        ]);
        return redirect()->route('login')->with('message', 'Pendaftaran berhasil, silahkan login!');
    }
    
}
