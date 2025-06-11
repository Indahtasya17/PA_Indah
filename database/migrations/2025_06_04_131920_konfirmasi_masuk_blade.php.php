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
        Schema::create('konfirmasi_masuk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi_barang');  
            $table->date('tanggal');
            $table->string('keterangan');
            $table->string('status');
            $table->timestamps();

            $table->foreign('id_transaksi_barang')->references('id')->on('transaksi_barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
