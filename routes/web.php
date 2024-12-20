<?php

use App\Http\Controllers\CarouselController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\GantiPassword;
use App\Http\Controllers\InfoMobilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VarianController;
use App\Models\Carousel;
use App\Models\Mobil;
use App\Models\Testimoni;
use App\Models\User;
use App\Models\Varian;
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
    $carousel = Carousel::all();
    $varianIds = Varian::pluck('id_mobil'); // Ambil semua id_mobil dari tabel varian
    $mobil = Mobil::limit(3)->whereIn('id', $varianIds)->get(); // Ambil mobil yang id-nya ada di dalam $varianIds
    $testimoni = Testimoni::orderBy('created_at', 'desc')->get();
    $user = User::find(1);
    $no = $user->no;
    return view('main', compact('carousel', 'mobil', 'testimoni', 'no'));
});

Route::get('/semua_mobil', [DetailController::class, 'index'])->name('semua_mobil');
Route::get('/detail_mobil/{id}', [DetailController::class, 'show'])->name('detail_mobil');
Route::get('/download-brosur-client/{id}', function($id) {
        return response()->download(storage_path('app/brosur/' . $id));
    })->name('download-brosur-client');

Route::get('/kontak', function () {
    $user = User::find(1);
    $no = $user->no;
    return view('kontak', compact('no'));
});

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

# Admin
Route::middleware(['Auth'])->group(function(){

    # Dashboard
    Route::get('/dashboard',  [DashboardController::class, 'index']);

    # Profil
    Route::get('/profil-user/edit/{id}', [ProfilController::class, 'edit'])->name('profil-user-edit');
    Route::put('/profil-user/update/{id}', [ProfilController::class, 'update'])->name('profil-user-update');

    Route::get('/gantiPassword/{id}', [GantiPassword::class, 'change'])->name('change-password');
    Route::put('/updatePassword/{id}', [GantiPassword::class, 'update'])->name('update-password');

    // users
    // Route::resource('user', UserController::class);

    // mobil
    Route::resource('mobil', MobilController::class);
    Route::get('/download-brosur/{id}', function($id) {
        return response()->download(storage_path('app/brosur/' . $id));
    })->name('download-brosur');

    // detail
    Route::resource('info_mobil', InfoMobilController::class);

    // varian
    Route::resource('varian', VarianController::class);

    // testimoni
    Route::resource('testimoni', TestimoniController::class);

    // testimoni
    Route::resource('carousel', CarouselController::class);

    // // invoice
    // Route::resource('invoice', InvoiceController::class);
    // Route::post('/submit_tarif/{id}', [InvoiceController::class, 'submit_tarif'])->name('submit_tarif');

    // // riwayat
    // Route::resource('riwayat', RiwayatController::class);
    // Route::get('/cetak_invoice/{id}', [RiwayatController::class, 'cetak_invoice'])->name('cetak_invoice');
    // Route::post('/riwayat_paid/{id}', [RiwayatController::class, 'riwayat_paid'])->name('riwayat_paid');
    // Route::get('/export-excel', [RiwayatController::class, 'export_excel'])->name('riwayat-export-excel');
    // Route::get('/export-pdf', [RiwayatController::class, 'export_pdf'])->name('riwayat-export-pdf');
});
