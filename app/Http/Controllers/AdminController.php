<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function homeAdmin() {
        $movie = Movie::all();
        return view('Admin.homeAdmin', compact('movie'));
    }
    function tambah(Movie $movie) {
        $genre = Genre::all();
        return view('Admin.tambahMovie', compact('genre', 'movie'));
    }

    public function postTambahMovie(Request $request)
    {
        $request->validate([
            "name" => "required",
            "genre_id" => "required",
            "image" => "required|image",
            "minutes" => "required",
            "director" => "required",
            "studio_name" => "required",
            "tayang" => "required|array",
            "studio_capacity" => "required",
            "deskripsi" => "required",
            "status" => "required",
        ]);

        // Gabungkan array jam tayang jadi string, misal: "13:00,16:00,19:00"
        $tayangList = implode(',', $request->tayang);

        Movie::create([
            'name' => $request->name,
            'genre_id' => $request->genre_id,
            'image' => $request->image->store('img', 'public'),
            'minutes' => $request->minutes,
            'tayang' => $tayangList,
            'director' => $request->director,
            'studio_name' => $request->studio_name,
            'studio_capacity' => $request->studio_capacity,
            'deskripsi' => $request->deskripsi,
            'status' => $request->status,
        ]);

        return redirect()->route('homeAdmin')->with('message', 'Berhasil menambah Movie');
    }

    function edit(Movie $movie)
    {
        $genre = Genre::all();

        $showtimes = [];
        if (!empty($movie->tayang)) {
            $showtimes = explode(',', $movie->tayang);
        }

        return view('Admin.editMovie', compact('movie', 'genre', 'showtimes'));
    }

    function postEditMovie(Request $request, Movie $movie)
    {
        $data = $request->validate([
            "name" => "required",
            "genre_id" => "required",
            "image" => "",
            "minutes" => "required",
            "director" => "required",
            "studio_name" => "required",
            "studio_capacity" => "required",
            "deskripsi" => "required",
            "status" => "required",
            "tayang" => "nullable|array",
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('img', 'public');
        } else {
            unset($data['image']);
        }

        if ($request->has('tayang')) {
            $data['tayang'] = implode(',', $request->tayang);
        }

        $movie->update($data);

        return redirect()->route('homeAdmin')->with('message', 'Movie Berhasil di edit');
    }


    function upComing() {
        $movie = Movie::all();
        return view('Admin.upComing', compact('movie'));
    }
    function masuk(Movie $movie) {
        $movie->update([
            'status' => 'ongoing',
        ]);
        return redirect()->route('homeAdmin')->with('message', 'Berhasil Memasukan');
    }
    function trash() {
        $movie = Movie::all();
        return view('Admin.trash', compact('movie'));
    }
    function trashArchived(Movie $movie) {
        $movie->update([
            'status' => 'archived',
        ]);
        return redirect()->route('trash')->with('message', 'Berhasil Memasukan');
    }
    function hapus(Movie $movie) {
        $movie->delete();
        return redirect()->route('trash')->with('message', 'Berhasil Menghapus');
    }
    function kelolaUser() {
        $user = User::where('role', '!=', 'admin')->get();

        return view('Admin.kelolaUser', ['user' => $user]);
    }
    function tambahUser() {
        return view('Admin.tambahUser');
    }

    function postTambahUser(Request $request) {
        $request->validate([
            'name' =>'required',
            'username' =>'required',
            'password' => 'required',
            'role' =>'required'
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('kelolaUser')->with('message', 'Berhasil Menambah User');
    }

    function editUser(User $user) {
        return view('Admin.editUser', compact('user'));
    }
    public function postEditUser(User $user, Request $request)
    {
        $data =  $request->validate([
            'name' => 'required',
            'username' => 'required',
        ]);

        $data['password'] = bcrypt($request->password);
        $user->update($data);

        return redirect()->route('kelolaUser')->with('message', 'user Berhasil di edit');
    }
    function hapusUser(User $user) {
        $user->delete();
        return redirect()->route('kelolaUser')->with('message', 'Berhasil Menghapus User');
    }
}
