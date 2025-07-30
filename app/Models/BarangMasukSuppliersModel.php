<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasukSuppliersModel extends Model
{
    //mendefinisikan nama tabel
    protected $table = 'barang_keluar_suppliers';
    //mengatur kolom yang boleh diisi
    protected $fillable = ['id_transaksi_barang','id_supplier'];
}
