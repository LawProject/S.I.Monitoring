<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KegiatanMahasiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RoleOrganisasiController;
use App\Http\Controllers\UserOrganisasiController;
use  App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Rute untuk menampilkan halaman register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Rute untuk melakukan proses registrasi
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware('role:admin')->name('admin.')->prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');
    Route::get('/kegiatan', [AdminController::class, 'kegiatan'])->name('kegiatan');
    Route::get('/kegiatanorg', [AdminController::class, 'kegiatanorg'])->name('kegiatanorg');
    //Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
    Route::get('/tambahmhs', [MahasiswaController::class, 'tambahmhs'])->name('tambahmhs');
    Route::post('/tambah', [MahasiswaController::class, 'tambah'])->name('tambah');
    Route::get('/tampildatamhs/{id}', [MahasiswaController::class, 'tampildatamhs'])->name('tampildatamhs');
    Route::post('updatemhs/{id}', [MahasiswaController::class, 'updatemhs'])->name('updatemhs');
    Route::get('deletemhs/{id}', [MahasiswaController::class, 'deletemhs'])->name('deletemhs');
    //eksport PDF
    Route::get('/eksportpdf', [MahasiswaController::class, 'eksportpdf'])->name('eksportpdf');
    //ekspor EXCEL
    Route::get('/eksportexcel', [MahasiswaController::class, 'eksportexcel'])->name('eksportexcel');
    //import EXCEl
    Route::post('/importexcel', [MahasiswaController::class, 'importexcel'])->name('importexcel');
    //login
    //register
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    //organisasi
    Route::get('/organisasi', [OrganisasiController::class, 'index'])->name('organisasi');
    Route::get('/tambahorganisasi', [OrganisasiController::class, 'tambahorganisasi'])->name('tambahorganisasi');
    Route::post('/tambahorg', [OrganisasiController::class, 'tambahorg'])->name('tambahorg');
    Route::get('/tampildataorg/{id}', [OrganisasiController::class, 'tampildataorg'])->name('tampildataorg');
    Route::post('/ubahdataorg/{id}', [OrganisasiController::class, 'ubahdataorg'])->name('ubahdataorg');
    Route::post('/updateorg/{id}', [OrganisasiController::class, 'updateorg'])->name('updateorg');
    Route::get('/deleteorg/{id}', [OrganisasiController::class, 'deleteorg'])->name('deleteorg');
    Route::resource('user', AdminUserController::class);
    Route::get('/tambahuser', [AdminUserController::class, 'tambahuser'])->name('tambahuser');
    //ekspor PDF
    Route::get('/eksportpdforg', [OrganisasiController::class, 'eksportpdforg'])->name('eksportpdforg');
    Route::get('/userOrgansiasi', [UserOrganisasiController::class, 'index'])->name('userOrgansiasi')->middleware('auth');
    Route::get('/createorganisasi', [UserOrganisasiController::class, 'createorganisasi'])->name('createorganisasi')->middleware('auth');
    Route::post('/tambahkanorrganisasi', [UserOrganisasiController::class, 'tambah'])->name('tambahkanorrganisasi')->middleware('auth');
    Route::get('/profile',  [AdminController::class, 'profile'])->name('profile')->middleware('auth:admin');
});
Route::middleware('role:user')->name('user.')->prefix('user')->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('user.index')->middleware('auth');
    Route::get('/kegiatanmhs', [UserController::class, 'kegiatanmhs'])->name('kegiatanmhs');
    Route::get('/upload', [UserController::class, 'upload'])->name('upload');
    Route::post('/tambahKegiatanMhs', [UserController::class, 'tambahKegiatanMhs'])->name('tambahKegiatanMhs');
    Route::get('/detail/{id}', [UserController::class, 'show']);
    Route::post('/logkegiatan', [UserController::class, 'logkegiatan'])->name('logkegiatan');

    Route::get('/profile/{user}', [UserController::class, 'profile'])->name('profile');

    Route::put('/profile/update/{id}', [UserController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
});

Route::middleware(['auth', 'role:organisasi'])->name('organisasi.')->prefix('organisasi')->group(function () {
    Route::get('/home', [RoleOrganisasiController::class, 'index'])->name('index');
    Route::get('/kegiatanorg', [RoleOrganisasiController::class, 'kegiatanorg'])->name('kegiatanorg');
    Route::get('/upload', [RoleOrganisasiController::class, 'upload'])->name('upload');
    Route::post('/tambahkegiatanorg', [RoleOrganisasiController::class, 'tambahkegiatanorg'])->name('tambahkegiatanorg');
});
