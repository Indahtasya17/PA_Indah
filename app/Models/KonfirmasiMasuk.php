<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonfirmasiMasuk extends Model
{
    protected $table = "konfirmasi_masuk";

    protected $fillable = [
        'id_transaksi_barang',
        'tanggal',
        'keterangan',
        'status'];

}
