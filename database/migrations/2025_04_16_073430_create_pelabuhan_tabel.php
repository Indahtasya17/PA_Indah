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
        Schema::create('pelabuhan', function (Blueprint $table) {
            $table->id();
            $table->date('nama barang');
            $table->string('tanggal');
            $table->integer('jumlah arang');
            $table->integer('nomor polisi');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelabuhan_tabel');
    }
};
