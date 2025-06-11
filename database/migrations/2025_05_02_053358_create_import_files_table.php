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
        Schema::create('import_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi_barang');
            $table->date('tanggal');
            $table->text('sales_contract');
            $table->text('invoice');
            $table->text('packing_List');
            $table->text('bill_of_loading');
            $table->text('phytosanitary_certificate');
            $table->text('health_certificate');
            $table->text('fumigation_certificate');
            $table->text('certificate_of_origin');
            $table->text('prior_notice');
            $table->text('insurance');
            $table->timestamps();

            $table->foreign('id_transaksi_barang')->references('id')->on('transaksi_barangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_files');
    }
};
