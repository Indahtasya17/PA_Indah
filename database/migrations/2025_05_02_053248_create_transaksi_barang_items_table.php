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
        Schema::create('transaksi_barang_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi_barang');  
            $table->unsignedBigInteger('id_barang');
            $table->double('harga');
            $table->integer('stock');
            $table->double('subtotal');

            $table->foreign('id_transaksi_barang')->references('id')->on('transaksi_barangs')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_barang_items');
    }
};
