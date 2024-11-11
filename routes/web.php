<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KasirController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showMovies'])->name('showMovies');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('postLogin', [AuthController::class, 'postLogin'])->name('postLogin');

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/history', [KasirController::class, 'history'])->name('history');
    //ADMIN
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

    //KASIRR
    Route::get('/detailmovie/{movie}', [KasirController::class, 'detailmovie'])->name('detailmovie');
    Route::get('seatSselection', [KasirController::class, 'index'])->name('seatSelection');
    Route::post('confirmOrder', [KasirController::class, 'confirmOrder'])->name('confirmOrder');
    Route::post('createOrder', [KasirController::class, 'createOrder'])->name('createOrder');
    Route::get('transaction/{id}', [KasirController::class, 'show'])->name('transaction');
    Route::get('ticket', [KasirController::class, 'ticket'])->name('ticket');
    Route::get('cari', [KasirController::class, 'cari'])->name('cari');
    Route::get('/filteredChart', [KasirController::class, 'filteredChartMethod'])->name('filteredChart');

});
