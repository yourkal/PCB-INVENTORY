<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('jenis_barang'); // Masuk, Keluar, Produksi
            $table->integer('jumlah_masuk')->nullable();
            $table->integer('jumlah_terpakai')->nullable();
            $table->integer('jumlah_tidak_terpakai')->nullable();
            $table->string('alasan_ketidakseimbangan')->nullable();
            $table->date('tanggal');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
