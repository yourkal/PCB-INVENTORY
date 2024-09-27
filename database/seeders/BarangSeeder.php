<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run()
    {
        // Tambahkan data contoh
        Barang::create([
            'nama_barang' => 'PCB A',
            'jenis_barang' => 'Komponen Elektronik',
            'jumlah_masuk' => 100,
            'jumlah_terpakai' => 30,
            'jumlah_tidak_terpakai' => 50,
            'tanggal' => '2024-09-01',
            'alasan_ketidakseimbangan' => 'Proses produksi tidak optimal',
            'jam_masuk' => '08:00',  // Jam masuk
            'jam_selesai' => '16:00', // Jam selesai
        ]);

        Barang::create([
            'nama_barang' => 'PCB B',
            'jenis_barang' => 'Komponen Elektronik',
            'jumlah_masuk' => 200,
            'jumlah_terpakai' => 150,
            'jumlah_tidak_terpakai' => 50,
            'tanggal' => '2024-09-05',
            'alasan_ketidakseimbangan' => null, // tidak ada alasan
            'jam_masuk' => '09:00',  // Jam masuk
            'jam_selesai' => '17:00', // Jam selesai
        ]);

        Barang::create([
            'nama_barang' => 'PCB C',
            'jenis_barang' => 'Komponen Elektronik',
            'jumlah_masuk' => 150,
            'jumlah_terpakai' => 50,
            'jumlah_tidak_terpakai' => 100,
            'tanggal' => '2024-09-10',
            'alasan_ketidakseimbangan' => 'Bahan baku tidak mencukupi',
            'jam_masuk' => '08:30',  // Jam masuk
            'jam_selesai' => '15:30', // Jam selesai
        ]);
    }
}
