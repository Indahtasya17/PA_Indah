<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluarCustomerModel extends Model
{
    protected $table = 'barang_keluar_customer';

    protected $fillable = ['id_transaksi_barang','nama_customer'];
}
