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
        Schema::create('pelabuhan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_barang');  
            $table->date('tanggal');
            $table->string('no_polisi');
            $table->string('jumlah_barang');
            $table->string('jumlah_container');
            $table->string('no_container');
            $table->string('kontak');
            $table->text('file');
            $table->timestamps();

            $table->foreign('id_barang')->references('id')->on('barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelabuhan');
    }
};
