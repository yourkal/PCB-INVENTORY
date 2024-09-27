<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama_barang',
        'jenis_barang',
        'jumlah_masuk',
        'jumlah_terpakai',
        'jumlah_tidak_terpakai',
        'alasan_ketidakseimbangan',
        'jam_masuk',
        'jam_selesai',
        'jumlah_selisih', // Tambahkan kolom jumlah_selisih di sini
    ];
}
