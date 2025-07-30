<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_supplier');
            $table->string('nama_barang');
            $table->double('harga_beli');
            $table->double('harga_jual');
            $table->double('stok');
            $table->integer('waktu_tunggu');
            $table->enum('sumber', ['import', 'lokal']);
            $table->string('kode_barang')->unique();
            $table->timestamps();

            $table->foreign('id_supplier')->references('id')->on('suppliers');
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
