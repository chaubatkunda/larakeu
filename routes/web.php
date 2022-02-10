<?php

use App\Http\Controllers\{
    DashboardController,
    LaporanController,
    MemberController,
    PemasukanController,
    PengeluaranController
};
use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;

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

Route::get('/', fn () =>  redirect(RouteServiceProvider::HOME));

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('pemasukan', PemasukanController::class);
    Route::get('/cetak/pemasukan', [PemasukanController::class, 'cetak'])->name('pemasukan.cetak');
    Route::resource('pengeluaran', PengeluaranController::class);
    Route::get('/cetak/pengeluaran', [PengeluaranController::class, 'cetak'])->name('pengeluaran.cetak');

    Route::prefix('admin')->group(function () {
        Route::get('/member', [MemberController::class, 'index'])->name('member.index');
        Route::get('/member/{user:id}', [MemberController::class, 'show'])->name('member.show');
        Route::get('/laporan/masuk', [LaporanController::class, 'masuk'])->name('laporan.masuk');
        Route::post('/laporan/masuk', [LaporanController::class, 'masuk'])->name('laporan.masuk');
        Route::get('/laporan/keluar', [LaporanController::class, 'keluar'])->name('laporan.keluar');
        Route::post('/laporan/keluar', [LaporanController::class, 'keluar'])->name('laporan.keluar');
    });
});

require __DIR__ . '/auth.php';
