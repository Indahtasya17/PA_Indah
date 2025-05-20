<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasukCustomerModel extends Model
{
    protected $table = 'barang_keluar_customer';

    protected $fillable = ['id_transaksi_barang','id_supplier'];
}
