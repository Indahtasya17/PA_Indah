<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiBarangModel extends Model
{
    protected $table = 'transaksi_barang';

    protected $fillable = ['id_user', 'tanggal', 'total_tagihan', 'no_polisi', 'tipe_transaksi', 'sumber_transaksi'];
}

