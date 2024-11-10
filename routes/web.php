<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showMovies'])->name('showMovies');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('postLogin', [AuthController::class, 'postLogin'])->name('postLogin');

Route::middleware(['auth'])->group(function () {
    Route::get('/homeAdmin', [AdminController::class, 'homeAdmin'])->name('homeAdmin');
    Route::get('/tambah', [AdminController::class, 'tambah'])->name('tambah');
    Route::post('/postTambahMovie', [AdminController::class, 'postTambahMovie'])->name('postTambahMovie');
    Route::get('/edit/{movie}', [AdminController::class, 'edit'])->name('edit');
    Route::post('/postEditMovie/{movie}', [AdminController::class, 'postEditMovie'])->name('postEditMovie');
    Route::get('/upComing', [AdminController::class, 'upComing'])->name('upComing');
    Route::get('/trash', [AdminController::class, 'trash'])->name('trash');
    Route::get('/trashArchived/{movie}', [AdminController::class, 'trashArchived'])->name('trashArchived');
    Route::get('/masuk/{movie}', [AdminController::class, 'masuk'])->name('masuk');
    Route::get('/hapus/{movie}', [AdminController::class, 'hapus'])->name('hapus');
    Route::get('/kelolaUser', [AdminController::class, 'kelolaUser'])->name('kelolaUser');
    Route::get('/tambahUser', [AdminController::class, 'tambahUser'])->name('tambahUser');
    Route::post('postTambahUser', [AdminController::class, 'postTambahUser'])->name('postTambahUser');
    Route::get('/editUser/{user}', [AdminController::class, 'editUser'])->name('editUser');
    Route::post('postEditUser/{user}', [AdminController::class, 'postEditUser'])->name('postEditUser');
    Route::get('/hapusUser/{user}', [AdminController::class, 'hapusUser'])->name('hapusUser');
});
