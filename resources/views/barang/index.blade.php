@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-4 mb-4"><i class="fas fa-box"></i> Daftar Barang</h2>

         {{-- form tmbh data --}}
         <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus-circle"></i> Tambah Barang</a>

    <!-- Form Filter -->
    <form action="{{ route('barang.index') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="filter_tanggal"><i class="fas fa-calendar-alt"></i> Filter Tanggal</label>
            <input type="date" class="form-control" id="filter_tanggal" name="filter_tanggal">
        </div>
        <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-filter"></i> Filter</button>
    </form>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Jumlah Masuk</th>
                <th>Jumlah Terpakai</th>
                <th>Jumlah Tidak Terpakai</th>
                <th>Alasan Ketidakseimbangan</th>
                <th>Jam Masuk</th>
                <th>Jam Selesai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangs as $barang)
            <tr>
                <td>{{ $barang->tanggal }}</td>
                <td>{{ $barang->nama_barang }}</td>
                <td>{{ $barang->jenis_barang }}</td>
                <td>{{ $barang->jumlah_masuk }} Kg</td>
                <td>{{ $barang->jumlah_terpakai }} Kg</td>
                <td>{{ $barang->jumlah_tidak_terpakai }} Kg</td>
                <td>{{ $barang->alasan_ketidakseimbangan }}</td>
                <td>{{ $barang->jam_masuk }}</td>
                <td>{{ $barang->jam_selesai }}</td>
                <td>
                    <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabel Total per Hari -->
    <h3 class="mt-4"><i class="fas fa-chart-line"></i> Total Jumlah Masuk, Terpakai, dan Tidak Terpakai</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Total Jumlah Masuk</th>
                <th>Total Jumlah Terpakai</th>
                <th>Total Jumlah Tidak Terpakai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($totals as $total)
            <tr>
                <td>{{ $total->tanggal }}</td>
                <td>{{ $total->total_masuk }}</td>
                <td>{{ $total->total_terpakai }}</td>
                <td>{{ $total->total_tidak_terpakai }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
