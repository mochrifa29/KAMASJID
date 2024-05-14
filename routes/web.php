<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\KasKeluarController;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RekapKasMasjidController;
use Illuminate\Support\Facades\Route;

Route::get('/',[Auth::class, 'index']);
Route::get('/dashboard',[Dashboard::class, 'index']);

Route::get('/kas_masuk/saldo_pemasukan',[KasMasukController::class, 'saldo_pemasukan']);
Route::get('/kas_keluar/saldo_pengeluaran',[KasKeluarController::class, 'saldo_pengeluaran']);

Route::get('/rekapKas_masjid/saldo_pemasukan',[RekapKasMasjidController::class, 'saldo_pemasukan']);
Route::get('/rekapKas_masjid/saldo_pengeluaran',[RekapKasMasjidController::class, 'saldo_pengeluaran']);
Route::get('/rekapKas_masjid/saldo_akhir',[RekapKasMasjidController::class, 'saldo_akhir']);

Route::put('/kas_masuk/update/{id}',[KasMasukController::class, 'update_kas_masuk']);
Route::put('/kas_keluar/update/{id}',[KasKeluarController::class, 'update_kas_keluar']);

Route::get('/laporan',[LaporanController::class, 'index']);


Route::resource('/kategori', KategoriController::class);
Route::resource('/pengguna', PenggunaController::class);
Route::resource('/kas_masuk', KasMasukController::class);
Route::resource('/kas_keluar', KasKeluarController::class);
Route::resource('/rekapKas_masjid', RekapKasMasjidController::class);
