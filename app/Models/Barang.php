<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'jenis_barang',
        'jumlah_masuk',
        'jumlah_terpakai',
        'jumlah_tidak_terpakai',
        'tanggal',
        'alasan_ketidakseimbangan',
        'jam_masuk', // Tambahkan ini
        'jam_selesai', // Tambahkan ini
    ];
}
