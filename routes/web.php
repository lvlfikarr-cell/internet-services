<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JenisLayananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', function () {
    session()->flush(); // hapus semua session
    return redirect('/login');
})->name('logout');

Route::get('/jenis-layanan', [JenisLayananController::class, 'index'])
    ->name('jenis-layanan.index');

Route::get('/transaksi', [TransaksiController::class, 'index'])
    ->name('transaksi.index');

Route::get('/riwayat', [TransaksiController::class, 'riwayat'])
    ->name('riwayat.index');


Route::resource('jenis-layanan', JenisLayananController::class);

Route::get(
    'transaksi/create/{layanan}',
    [TransaksiController::class, 'create']
)->name('transaksi.create');

Route::resource('transaksi', TransaksiController::class);

Route::get('/transaksi/berlangganan/{layanan}', 
    [TransaksiController::class, 'create']
)->name('transaksi.berlangganan');

Route::resource('transaksi', TransaksiController::class)->except(['create']);


Route::get('/riwayat', [TransaksiController::class, 'riwayat'])
    ->name('riwayat.index');


