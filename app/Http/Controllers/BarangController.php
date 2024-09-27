<?php

namespace App\Http\Controllers;


use DB;
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

        // Cek jika ada pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->search . '%')
                    ->orWhere('jenis_barang', 'like', '%' . $request->search . '%');
            });
        }

        // Ambil semua data barang yang sudah difilter
        $barangs = $query->get();

        // Menghitung total per hari dari hasil pencarian atau filter
        $totals = $query->select(
            'tanggal',
            \DB::raw('SUM(jumlah_masuk) as total_masuk'),
            \DB::raw('SUM(jumlah_terpakai) as total_terpakai'),
            \DB::raw('SUM(jumlah_tidak_terpakai) as total_tidak_terpakai'),
            \DB::raw('SUM(jumlah_masuk - jumlah_terpakai - jumlah_tidak_terpakai) as total_selisih')
        )
            ->groupBy('tanggal')
            ->get();

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
        ]);

        // Logika ketidakseimbangan
        $total_proses = $request->jumlah_terpakai + $request->jumlah_tidak_terpakai;

        if ($total_proses != $request->jumlah_masuk) {
            $request->validate([
                'alasan_ketidakseimbangan' => 'required|string'
            ]);
        }

        // Hitung jumlah selisih
        $jumlah_selisih = $request->jumlah_masuk - ($request->jumlah_terpakai + $request->jumlah_tidak_terpakai);

        // Simpan data barang
        Barang::create(array_merge($request->all(), ['jumlah_selisih' => $jumlah_selisih]));

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
        ]);

        // Hitung jumlah selisih
        $jumlah_selisih = $request->jumlah_masuk - ($request->jumlah_terpakai + $request->jumlah_tidak_terpakai);

        // Update data barang
        $barang = Barang::findOrFail($id);
        $barang->update(array_merge($request->all(), ['jumlah_selisih' => $jumlah_selisih]));

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diupdate');
    }


    // Hapus barang
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete(); // Hapus barang dari database

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
