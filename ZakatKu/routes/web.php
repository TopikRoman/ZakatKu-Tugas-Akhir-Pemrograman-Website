<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\dashBoardAdmin;
use App\Http\Controllers\user\TransaksiZakatController;
use App\Http\Controllers\admin\AdminTransaksiZakatController;
use App\Http\Controllers\admin\PembayaranZakatController;
use App\Http\Controllers\user\RiwayatPembayaranZakat;
use App\Http\Controllers\MetodeZakatController;
use App\Http\Controllers\user\TripayAPI;
use App\Http\Controllers\admin\PembagianZakatController;
use App\Http\Controllers\admin\AdminPenyaluranZakatController;


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
    if (Auth::check()) {
        return Auth::user()->roleId == 1
            ? redirect('admin/adminDashboard')
            : redirect('/dashboard');
    }

    // Jika belum login (guest), tampilkan halaman welcome atau guestIndex
    // Jika ingin tampilkan welcome.blade.php:
    return view('welcome');

    // Atau jika ingin menggunakan controller khusus untuk guest
    // return app(UserDashboardController::class)->guestIndex();
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('admin/adminDashboard', [dashBoardAdmin::class, 'index'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/transaksi-zakat/index', [TransaksiZakatController::class, 'index'])->name('transaksi-zakat.index');
    Route::post('/transaksi-zakat/store', [TransaksiZakatController::class, 'store'])->name('transaksi-zakat.store');
    Route::post('/zakat/upload-bukti', [TransaksiZakatController::class, 'uploadBukti'])->name('upload.bukti');

});

Route::middleware('auth')->group(function () {
    Route::get('/admin/pembayaran', [PembayaranZakatController::class, 'index'])->name('admin.pembayaran.index');
    Route::post('/admin/pembayaran', [PembayaranZakatController ::class, 'tambahTahunIni'])->name('admin.pembayaran.tambahTahunIni');
    Route::get('/admin/zakat/edit-status/{id}', [PembayaranZakatController::class, 'editStatus'])->name('admin.zakat.editStatus');
    Route::put('/admin/zakat/update-status/{id}', [PembayaranZakatController::class, 'updateStatus'])->name('admin.zakat.updateStatus');
    Route::get('/admin/zakat/menunggu-verifikasi', [PembayaranZakatController::class, 'listMenungguVerifikasi'])->name('admin.zakat.verifikasiList');
    Route::get('/admin/zakat/tahun/{tahun}/export-pdf', [PembayaranZakatController::class, 'exportPdf'])->name('admin.zakat.exportPdf');


});

Route::middleware('auth')->group(function () {
    Route::get('/admin/pembayaran/{id}', [PembayaranZakatController::class, 'showYear'])->name('admin.pembayaran.showYear');
});

route::middleware('auth')->group(function () {
    Route::get('/user/riwayat', [RiwayatPembayaranZakat::class, 'riwayat'])->name('user.riwayat');
    Route::get('/user/riwayat/redirect/{id}', [RiwayatPembayaranZakat::class, 'redirect'])->name('riwayat.redirect');
    Route::get('/user/riwayat/bayar/{id}', [RiwayatPembayaranZakat::class, 'bayar'])->name('riwayat.bayar');
    Route::get('/user/riwayat/menunggu/{id}', [RiwayatPembayaranZakat::class, 'menunggu'])->name('riwayat.menunggu');
    Route::get('/user/riwayat/selesai/{id}', [RiwayatPembayaranZakat::class, 'selesai'])->name('riwayat.selesai');
});

route::middleware('auth')->group(function () {
    Route::get('/zakat/pilih-metode/{id}', [MetodeZakatController::class, 'pilihMetode'])->name('zakat.pilihMetode');
    Route::post('/zakat/pilih-metode', [MetodeZakatController::class, 'metodeStore'])->name('zakat.simpanMetode');
    Route::get('/zakat/detail/{noReferensi}', [MetodeZakatController::class, 'detailShow'])->name('zakat.detailShow');
});

Route::middleware(['auth', 'isMuzakki'])->prefix('admin')->group(function () {
    Route::resource('muzakki', App\Http\Controllers\admin\MuzakkiController::class);
});

Route::middleware(['auth', 'isAmil'])->prefix('admin')->group(function () {
    Route::resource('amil', App\Http\Controllers\admin\AmilController::class);
});

route::middleware('auth')->group(function () {
    Route::get('/transaksi/create', [AdminTransaksiZakatController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [AdminTransaksiZakatController::class, 'store'])->name('transaksi.store');
});

route::middleware('auth')->group(function () {
    Route::get('/pembagian', [PembagianZakatController::class, 'index'])->name('pembagian.index');
    Route::post('/pembagian/tambah-tahun-ini', [PembagianZakatController::class, 'tambahTahunIni'])->name('tambahTahunIni');
    Route::get('/pembagian/tahun/{id}', [PembagianZakatController::class, 'showYear'])->name('admin.pembagianZakat.show');
});
route::middleware('auth')->group(function () {
    Route::get('/penyaluran/create', [AdminPenyaluranZakatController::class, 'createForm'])->name('penyaluran.create');
    Route::post('/penyaluran/tambah', [AdminPenyaluranZakatController::class, 'store'])->name('penyaluran.store');
    Route::get('/penyaluran/export-pdf/{tahun}', [AdminPenyaluranZakatController::class, 'exportPdf'])->name('admin.penyaluran.exportPdf');

});
// Route::middleware(['auth', 'isMuzakki'])->group(function () {
//     Route::post('/tripay', [TripayAPI::class, 'tripay'])->name('pembayaranZakat.tripay');
// });
