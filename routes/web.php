<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TransaksiController;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::middleware('auth')->group(function() {
    Route::middleware('role:admin')->group(function(){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::get('kasir', [KasirController::class, 'index'])->name('kasir.index');
        Route::put('kasir/{user}', [KasirController::class, 'update'])->name('kasir.update');
        Route::delete('kasir/{user}', [KasirController::class, 'destroy'])->name('kasir.destroy');

        Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
        Route::post('pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
        Route::put('pelanggan/{pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.update');
        Route::delete('pelanggan/{pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
        Route::get('pelanggan/templatepelanggan', [PelangganController::class, 'templatepelanggan'])->name('pelanggan.templatepelanggan');
        Route::post('pelanggan/importpelanggan', [PelangganController::class, 'importpelanggan'])->name('pelanggan.import');

        Route::get('barang/generate', [BarangController::class, 'generate_barcode'])->name('barang.generate');
        Route::post('/cetak_barcode', [BarangController::class, 'cetak_barcode'])->name('barang.cetak_barcode');
        Route::get('templatebarang', [BarangController::class, 'templatebarang'])->name('templatebarang');
        Route::get('exportbarang', [BarangController::class, 'exportbarang'])->name('exportbarang');
        Route::post('importbarang', [BarangController::class, 'importbarang'])->name('importbarang');
        Route::resource('barang', BarangController::class);
    
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/laporan/{transaksi}/detail', [LaporanController::class, 'detail'])->name('laporan.detail');
        Route::get('laporan/exportexcel', [LaporanController::class, 'exportexcel'])->name('laporan.exportexcel');
        Route::get('laporan/exportpdf', [LaporanController::class, 'exportpdf'])->name('laporan.exportpdf');
    });
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/cash', [TransaksiController::class, 'transaksi_cash'])->name('transaksi.cash');
    Route::post('/transaksi/credit', [TransaksiController::class, 'transaksi_credit'])->name('transaksi.credit');

    Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan.index');
});

require __DIR__.'/auth.php';
