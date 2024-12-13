<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function showMovies() {
        $movies = Movie::with('genre')->get();
        return view('home', ['movie' => $movies]);
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
                return redirect()->route('homeAdmin')->with('message', 'Login Berhasil, Selamat Datang '. $user->name);
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
            return redirect()->route('login')->with('message', 'Logout Berhasil');
        }
    }
}
