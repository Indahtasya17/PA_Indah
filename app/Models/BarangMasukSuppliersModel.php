<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasukSuppliersModel extends Model
{
    protected $table = 'barang_keluar_suppliers';

    protected $fillable = ['id_transaksi_barang','id_supplier'];
}
