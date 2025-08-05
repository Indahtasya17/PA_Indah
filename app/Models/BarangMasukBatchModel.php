<?php

namespace App\Models;

use App\Models\BarangModel;
use Illuminate\Database\Eloquent\Model;

class BarangMasukBatchModel extends Model
{
    protected $table = 'barang_masuk_batch';

    protected $fillable = [
        'id_barang',
        'transaksi_items_id',
        'jumlah_awal',
        'sisa',
        'harga_beli',
    ];

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'id_barang');
    }
}