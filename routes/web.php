<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::get('/', [BarangController::class, 'index']);

Route::resource('barang', BarangController::class);

Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create'); // Form Buat Barang Baru
Route::post('barang', [BarangController::class, 'store'])->name('barang.store'); // Aksi Simpan Data Baru
Route::get('barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit'); // Form Edit Barang
Route::put('barang/{id}', [BarangController::class, 'update'])->name('barang.update'); // Aksi Simpan Data Hasil Edit
Route::delete('barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy'); // Aksi Hapus Barang


