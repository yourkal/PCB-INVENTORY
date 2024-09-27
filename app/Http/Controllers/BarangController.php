<?php

namespace App\Http\Controllers;


use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    public function index(Request $request)
    {
        $query = Barang::query();
    
        // Cek jika ada filter tanggal
        if ($request->has('filter_tanggal') && $request->filter_tanggal != '') {
            $query->whereDate('tanggal', $request->filter_tanggal);
        }
    
        // Ambil semua data barang yang sudah difilter
        $barangs = $query->get();
    
        // Menghitung total per hari
        $totals = $query->select('tanggal', 
            \DB::raw('SUM(jumlah_masuk) as total_masuk'), 
            \DB::raw('SUM(jumlah_terpakai) as total_terpakai'), 
            \DB::raw('SUM(jumlah_tidak_terpakai) as total_tidak_terpakai'))
            ->groupBy('tanggal')
            ->get();
    
        // Kirim data barang dan total per hari ke view index.blade.php
        return view('barang.index', compact('barangs', 'totals'));
    }
    
    
    
    // Tampilkan form buat barang baru
    public function create()
    {
        return view('barang.create');
    }

    // Simpan barang baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'jumlah_masuk' => 'required|numeric',
            'jumlah_terpakai' => 'required|numeric',
            'jumlah_tidak_terpakai' => 'required|numeric',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);

        // Logika ketidakseimbangan
        $total_proses = $request->jumlah_terpakai + $request->jumlah_tidak_terpakai;

        if ($total_proses != $request->jumlah_masuk) {
            $request->validate([
                'alasan_ketidakseimbangan' => 'required|string'
            ]);
        }

        // Simpan data barang
        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil ditambahkan');
    }


    // Tampilkan form edit barang
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }
    // tampilkan hasil edit
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'jumlah_masuk' => 'required|numeric',
            'jumlah_terpakai' => 'required|numeric',
            'jumlah_tidak_terpakai' => 'required|numeric',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui');
    }


    // Hapus barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete(); // Hapus barang dari database

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
