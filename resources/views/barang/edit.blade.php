@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-4 mb-4"><i class="fas fa-edit"></i> Edit Barang</h2>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="tanggal"><i class="fas fa-calendar-alt"></i> Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $barang->tanggal }}" required>
        </div>

        <div class="form-group">
            <label for="nama_barang"><i class="fas fa-box"></i> Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $barang->nama_barang }}" required>
        </div>

        <div class="form-group">
            <label for="jenis_barang"><i class="fas fa-tag"></i> Jenis Barang</label>
            <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="{{ $barang->jenis_barang }}" required>
        </div>

        <div class="form-group">
            <label for="jumlah_masuk"><i class="fas fa-arrow-alt-circle-up"></i> Jumlah Masuk</label>
            <input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk" value="{{ $barang->jumlah_masuk }}" required>
        </div>

        <div class="form-group">
            <label for="jumlah_terpakai"><i class="fas fa-arrow-alt-circle-down"></i> Jumlah Terpakai</label>
            <input type="number" class="form-control" id="jumlah_terpakai" name="jumlah_terpakai" value="{{ $barang->jumlah_terpakai }}" required>
        </div>

        <div class="form-group">
            <label for="jumlah_tidak_terpakai"><i class="fas fa-times-circle"></i> Jumlah Tidak Terpakai</label>
            <input type="number" class="form-control" id="jumlah_tidak_terpakai" name="jumlah_tidak_terpakai" value="{{ $barang->jumlah_tidak_terpakai }}" required>
        </div>

        <div class="form-group">
            <label for="alasan_ketidakseimbangan"><i class="fas fa-exclamation-circle"></i> Alasan Ketidakseimbangan</label>
            <input type="text" class="form-control" id="alasan_ketidakseimbangan" name="alasan_ketidakseimbangan" value="{{ $barang->alasan_ketidakseimbangan }}">
        </div>

        <div class="form-group">
            <label for="jam_masuk"><i class="fas fa-clock"></i> Jam Masuk</label>
            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="{{ $barang->jam_masuk }}" required>
        </div>

        <div class="form-group">
            <label for="jam_selesai"><i class="fas fa-clock"></i> Jam Selesai</label>
            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ $barang->jam_selesai }}" required>
        </div>

        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary"><i class="fas fa-ban"></i> Batal</a>
    </form>
</div>

<style>
    .container {
        max-width: 600px;
        margin: auto;
    }
</style>
@endsection
