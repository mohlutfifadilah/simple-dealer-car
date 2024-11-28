<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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
    return view('main');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

# Admin
Route::get('/dashboard',  [DashboardController::class, 'index']);
Route::middleware(['Auth'])->group(function(){
    // Route::get('/profil-user/edit/{id}', [ProfilController::class, 'edit'])->name('profil-user-edit');
    // Route::put('/profil-user/update/{id}', [ProfilController::class, 'update'])->name('profil-user-update');

    // // users
    // Route::resource('users', UsersController::class);

    // // kategori
    // Route::resource('kategori', KategoriController::class);

    // // armada
    // Route::resource('armada', ArmadaController::class);

    // // invoice
    // Route::resource('invoice', InvoiceController::class);
    // Route::post('/submit_tarif/{id}', [InvoiceController::class, 'submit_tarif'])->name('submit_tarif');

    // // riwayat
    // Route::resource('riwayat', RiwayatController::class);
    // Route::get('/cetak_invoice/{id}', [RiwayatController::class, 'cetak_invoice'])->name('cetak_invoice');
    // Route::post('/riwayat_paid/{id}', [RiwayatController::class, 'riwayat_paid'])->name('riwayat_paid');
    // Route::get('/export-excel', [RiwayatController::class, 'export_excel'])->name('riwayat-export-excel');
    // Route::get('/export-pdf', [RiwayatController::class, 'export_pdf'])->name('riwayat-export-pdf');

    // Route::get('/gantiPassword/{id}', [GantiPassword::class, 'change'])->name('change-password');
    // Route::put('/updatePassword/{id}', [GantiPassword::class, 'update'])->name('update-password');
});
