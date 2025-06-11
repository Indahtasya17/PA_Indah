<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangImportMasukModel extends Model
{
    protected $table = 'barang_import_masuk';

    protected $fillable = ['id_transaksi_barang','no_invoice','no_kontener'];
}
