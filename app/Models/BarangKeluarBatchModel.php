<?php

namespace App\Models;

use App\Models\BarangMasukBatchModel;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarBatchModel extends Model
{
    protected $table = 'barang_keluar_batch';

    protected $fillable = [
        'id_barang',
        'transaksi_items_id',
        'barang_masuk_batch_id',
        'stok',
    ];

    public function barang_masuk_batch()
    {
        return $this->belongsTo(BarangMasukBatchModel::class, 'barang_masuk_batch_id');
    }
}
