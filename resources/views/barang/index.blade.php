@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mt-4 mb-4"><i class="fas fa-box"></i> Daftar Barang PCB</h2>

        {{-- form tmbh data --}}
        <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus-circle"></i> Tambah
            Barang</a>

       <!-- Teks dan ikon untuk pencarian dan filter -->
<div class="mb-4">
    <h5><i class="fas fa-search"></i> Pencarian dan Filter Data Barang</h5>
    <p>Gunakan form di bawah ini untuk mencari barang berdasarkan nama atau jenis barang, serta filter data berdasarkan tanggal atau bulan tertentu.</p>
</div>

<!-- Form pencarian, filter tanggal, dan filter bulan dalam satu row -->
<div class="row mb-3">
    <!-- Pencarian Barang -->
    <div class="col-md-6">
        <form action="{{ route('barang.index') }}" method="GET">
            <div class="mb-2">
                <label for="search"><i class="fas fa-box"></i> Cari Barang</label>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-box-open"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari Nama atau Jenis Barang" 
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <!-- Filter Tanggal -->
    <div class="col-md-3">
        <form action="{{ route('barang.index') }}" method="GET">
            <div class="mb-2">
                <label for="filter_tanggal"><i class="fas fa-calendar-alt"></i> Filter Tanggal</label>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                <input type="date" class="form-control" id="filter_tanggal" name="filter_tanggal" value="{{ request('filter_tanggal') }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </form>
    </div>

    <!-- Filter Bulan -->
    <div class="col-md-3">
        <form action="{{ route('barang.index') }}" method="GET">
            <div class="mb-2">
                <label for="filter_bulan"><i class="fas fa-calendar"></i> Filter Bulan</label>
            </div>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                <input type="month" name="filter_bulan" id="filter_bulan" class="form-control" value="{{ request('filter_bulan') }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </form>
    </div>
</div>


        

        <!-- CSS untuk membuat tabel dengan sudut lengkung dan garis pembatas -->
        <style>
            table {
                border-collapse: separate;
                border-spacing: 0;
                border-radius: 10px;
                overflow: hidden;
                width: 100%;
            }

            table,
            th,
            td {
                border: 1px solid #dddddd;
                /* Warna garis pembatas */
            }

            thead {
                border-radius: 10px 10px 0 0;
            }

            th,
            td {
                padding: 10px;
                text-align: left;
            }

            /* Mengatur agar garis tidak terlihat terpotong di sudut */
            table thead th:first-child {
                border-top-left-radius: 10px;
            }

            table thead th:last-child {
                border-top-right-radius: 10px;
            }

            table tbody tr:last-child td:first-child {
                border-bottom-left-radius: 10px;
            }

            table tbody tr:last-child td:last-child {
                border-bottom-right-radius: 10px;
            }

            .action-buttons {
                display: flex;
                justify-content: space-between;
            }

            .action-buttons a,
            .action-buttons form {
                margin-right: 5px;
            }

            .action-buttons form {
                display: inline-block;
            }
        </style>

        <!-- Tabel Data Barang -->
        <h5 class="mt-4">Data Barang PCB</h5>
        <table class="table table-bordered table-hover mt-3">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Barang(Asal)</th>
                    <th>Jenis Barang</th>
                    <th>Jumlah Masuk</th>
                    <th>Jumlah Terpakai</th>
                    <th>Jumlah Tidak Terpakai</th>
                    <th>Jumlah Selisih</th>
                    <th>Alasan Ketidakseimbangan</th>
                    <th>Jam Masuk</th>
                    <th>Jam Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangs as $barang)
                    <tr>
                        <td>{{ $barang->tanggal }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->jenis_barang }}</td>
                        <td>{{ $barang->jumlah_masuk }}</td>
                        <td>{{ $barang->jumlah_terpakai }}</td>
                        <td>{{ $barang->jumlah_tidak_terpakai }}</td>
                        <td>{{ $barang->jumlah_masuk - $barang->jumlah_terpakai - $barang->jumlah_tidak_terpakai }}</td>
                        <td>{{ $barang->alasan_ketidakseimbangan }}</td>
                        <td>{{ $barang->jam_masuk }}</td>
                        <td>{{ $barang->jam_selesai }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Tabel Total per Hari -->
        <h5 class="mt-4">Total Jumlah PCB per Hari</h5>
        <table class="table table-bordered table-striped">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Tanggal</th>
                    <th>Total Jumlah Masuk</th>
                    <th>Total Jumlah Terpakai</th>
                    <th>Total Jumlah Tidak Terpakai</th>
                    <th>Total Jumlah Selisih</th>
                </tr>
            </thead>
            <tbody>
                @forelse($totals as $total)
                    <tr>
                        <td>{{ $total->tanggal }}</td>
                        <td>{{ $total->total_masuk }}</td>
                        <td>{{ $total->total_terpakai }}</td>
                        <td>{{ $total->total_tidak_terpakai }}</td>
                        <td>{{ $total->total_selisih }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Total tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Tabel Total per Bulan -->
<h5 class="mt-4">Total Jumlah PCB per Bulan</h5>
<table class="table table-bordered mt-4">
    <thead class="thead-dark">
        <tr>
            <th>Bulan</th>
            <th>Total Jumlah Masuk</th>
            <th>Total Jumlah Terpakai</th>
            <th>Total Jumlah Tidak Terpakai</th>
            <th>Total Jumlah Selisih</th>
        </tr>
    </thead>
    <tbody>
        @forelse($totals as $total)
        <tr>
            <td>{{ $total->bulan }}</td> <!-- Menampilkan bulan dalam format YYYY-MM -->
            <td>{{ $total->total_masuk }}</td> <!-- Total barang masuk -->
            <td>{{ $total->total_terpakai }}</td> <!-- Total barang terpakai -->
            <td>{{ $total->total_tidak_terpakai }}</td> <!-- Total barang tidak terpakai -->
            <td>{{ $total->total_selisih }}</td> <!-- Total selisih -->
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Total tidak ditemukan</td>
        </tr>
        @endforelse
    </tbody>
</table>

        
    </div>
@endsection
