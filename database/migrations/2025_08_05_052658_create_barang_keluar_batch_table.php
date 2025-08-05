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
        Schema::create('barang_keluar_batch', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barang');
            $table->unsignedBigInteger('transaksi_items_id');
            $table->unsignedBigInteger('barang_masuk_batch_id');
            $table->integer('stok');
            $table->timestamps();


            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');
            $table->foreign('transaksi_items_id')->references('id')->on('transaksi_barang_items')->onDelete('cascade');
            $table->foreign('barang_masuk_batch_id')->references('id')->on('barang_masuk_batch')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluar_batch');
    }
};
