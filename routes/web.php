<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Laporan2Controller;
use App\Http\Controllers\RiwayatController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});



Route::get('/tes', function () {
    return view('test');
});

Route::get('/profile', [UserController::class, 'profile'])->name('profil')->middleware('auth');

//login
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/aksilogin', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

//dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware('auth');
Route::get('/dashboard/{tahun}', [DashboardController::class, 'cari'])->middleware('auth');

// petugas
Route::get('/petugas', [UserController::class, 'index'])->middleware('auth');
Route::post('/petugas/insert', [UserController::class, 'store']);
Route::get('/petugas/{id}', [UserController::class, 'edit'])->middleware('auth');
Route::post('/petugas/update/{id}', [UserController::class, 'updateProfile']);
Route::post('/petugas/updatePW/{id}', [UserController::class, 'updatePW']);
Route::post('/petugas/updatePic/{id}', [UserController::class, 'updatePic']);
Route::post('/petugas/deletePic/{id}', [UserController::class, 'deletePic']);
Route::post('/petugas/hapus/{id}', [UserController::class, 'hapus']);

// barang
Route::get('/barang', [BarangController::class, 'index'])->middleware('auth');
Route::post('/barang/insert', [BarangController::class, 'store']);
Route::post('/barang/{id}', [BarangController::class, 'update']);
Route::get('/barang/hapus/{id}', [BarangController::class, 'hapus']);

// barang masuk
Route::get('/barangMasuk', [BarangMasukController::class, 'index'])->middleware('auth');
Route::post('/toKeranjang2/{id}', [BarangMasukController::class, 'toKeranjang']);
Route::post('/bayar2', [BarangMasukController::class, 'bayar']);
Route::post('/hapusKeranjang2/{id}', [BarangMasukController::class, 'hapusKeranjang']);
Route::post('/resetKeranjang2', [BarangMasukController::class, 'resetKeranjang']);
Route::post('/refreshKeranjang2/{id}', [BarangMasukController::class, 'refreshKeranjang']);
Route::post('/session', [BarangMasukController::class, 'session']);

// kasir
Route::get('/kasir', [KasirController::class, 'index'])->middleware('auth');
Route::post('/toKeranjang/{id}', [KasirController::class, 'toKeranjang']);
Route::post('/bayar', [KasirController::class, 'bayar']);
Route::post('/hapusKeranjang/{id}', [KasirController::class, 'hapusKeranjang']);
Route::post('/resetKeranjang', [KasirController::class, 'resetKeranjang']);
Route::post('/refreshKeranjang/{id}', [KasirController::class, 'refreshKeranjang']);
Route::get('/struk/{no_penjualan}', [KasirController::class, 'struk']);



//laporan Jual
Route::get('/laporan-penjualan', [LaporanController::class, 'index'])->middleware('auth');
Route::post('/laporan-penjualan/cari', [LaporanController::class, 'cari'])->middleware('auth');
// Route::get('/cetak-laporan-penjualan/{bulan}/{tahun}', [LaporanController::class, 'cetakLaporan'])->middleware('auth');
Route::get('/cetak-laporan-penjualan/{tglawal}/{tglakhir}', [LaporanController::class, 'cetakLaporan'])->middleware('auth');

//laporan Beli
Route::get('/laporan-pembelian', [Laporan2Controller::class, 'index'])->middleware('auth');
Route::post('/laporan-pembelian/cari', [Laporan2Controller::class, 'cari'])->middleware('auth');
// Route::get('/cetak-laporan-penjualan/{bulan}/{tahun}', [LaporanController::class, 'cetakLaporan'])->middleware('auth');
Route::get('/cetak-laporan-pembelian/{tglawal}/{tglakhir}', [Laporan2Controller::class, 'cetakLaporan'])->middleware('auth');

//riwayat
Route::get('/penjualan', [RiwayatController::class, 'jual'])->middleware('auth');
Route::get('/penjualan/{id}', [RiwayatController::class, 'jualdetail'])->middleware('auth');

Route::get('/pembelian', [RiwayatController::class, 'beli'])->middleware('auth');
Route::get('/pembelian/{id}', [RiwayatController::class, 'belidetail'])->middleware('auth');

Route::get('/historiLogin', [LoginController::class, 'histori']);
