<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// route khusus admin
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin-dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/hapus/{id}', [App\Http\Controllers\AdminController::class, 'hapus'])->name('hapus');
    Route::get('/admin-tasklist', [App\Http\Controllers\AdminController::class, 'tasklist'])->name('admin.tasklist');
    Route::get('/admin-ubah/{tugasId}', [App\Http\Controllers\AdminController::class, 'ubah'])->name('admin.ubah');
    Route::post('/admin-ubah/{tugasId}', [App\Http\Controllers\AdminController::class, 'ubahdata'])->name('admin.ubahdata');
    Route::get('/admin-history', [App\Http\Controllers\AdminController::class, 'history'])->name('admin.history');
    Route::get('/admin-leaderboard', [App\Http\Controllers\AdminController::class, 'leaderboard'])->name('admin.leaderboard');
    Route::get('/admin/{user}/update-score', [App\Http\Controllers\AdminController::class, 'Score'])->name('admin.score');
    Route::post('/admin/{user}/update-score', [App\Http\Controllers\AdminController::class, 'updateScore'])->name('admin.update-score');


});

// route untuk user
Route::get('/user-dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/user-tasklist', [App\Http\Controllers\UserController::class, 'tasklist'])->name('user.tasklist');
Route::get('/user-ubah/{tugasId}', [App\Http\Controllers\UserController::class, 'ubah'])->name('user.ubah');
Route::post('/user-ubah/{tugasId}', [App\Http\Controllers\UserController::class, 'ubahdata'])->name('user.ubahdata');
Route::get('/user-leaderboard', [App\Http\Controllers\UserController::class, 'leaderboard'])->name('user.leaderboard');
Route::get('/user-edit-hasil/{tugasId}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');



// route untuk tambah tugas
Route::get('/tambah', [App\Http\Controllers\TugasController::class, 'tambah'])->name('tambah');
Route::post('/simpan', [App\Http\Controllers\TugasController::class, 'simpan'])->name('simpan');

// route ubah status nya
Route::get('/ubahstatus/{idtugas}/{status}', [App\Http\Controllers\TugasController::class, 'ubahstatus'])->name('ubahstatus');

// route jadwal
Route::get('/jadwal', [App\Http\Controllers\JadwalController::class, 'jadwal'])->name('jadwal');
Route::get('/form-jadwal', [App\Http\Controllers\JadwalController::class, 'form'])->name('form.jadwal');
Route::post('/tambah-jadwal', [App\Http\Controllers\JadwalController::class, 'tambah'])->name('tambah.jadwal');
Route::get('/jadwal/{id}/edit', [App\Http\Controllers\JadwalController::class, 'edit'])->name('jadwal.edit');
Route::post('/jadwal/{id}', [App\Http\Controllers\JadwalController::class, 'update'])->name('jadwal.update');
Route::get('/jadwal/hapus/{id}', [App\Http\Controllers\JadwalController::class, 'hapus'])->name('hapus.jadwal');

// route profil
Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'profil'])->name('profil');
Route::get('/edit-profil', [App\Http\Controllers\ProfilController::class, 'editprofil'])->name('profil.edit');
Route::post('/profil-update', [App\Http\Controllers\ProfilController::class, 'update'])->name('profil.update');

// route untuk ngirim hasil tugas
Route::get('/tugas/{tugasId}/selesai', [App\Http\Controllers\TugasController::class, 'showForm'])->name('tugas.selesai');
Route::post('/tugas/{tugasId}/selesai', [App\Http\Controllers\TugasController::class, 'storeHasilTugas'])->name('hasil-tugas.store');
Route::get('/detail/{tugasId}', [App\Http\Controllers\TugasController::class, 'show'])->name('tugas.detail');
Route::get('/tugas-hasil/{tugasId}', [App\Http\Controllers\TugasController::class, 'hasil'])->name('hasil.hasil');
Route::get('/tugas-edit-hasil/{tugasId}', [App\Http\Controllers\TugasController::class, 'edithasil'])->name('hasil.edit-hasil');
Route::post('/tugas-edit-hasil/{tugasId}', [App\Http\Controllers\TugasController::class, 'kirimHasil'])->name('tugas.editstore');









