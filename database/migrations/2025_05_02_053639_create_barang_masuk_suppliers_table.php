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
        Schema::create('barang_masuk_customer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi_barang');
            $table->unsignedBigInteger('id_supplier');
            $table->timestamps();

            $table->foreign('id_transaksi_barang')->references('id')->on('transaksi_barangs')->onDelete('cascade');
            $table->foreign('id_supplier')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk_suppliers');
    }
};
