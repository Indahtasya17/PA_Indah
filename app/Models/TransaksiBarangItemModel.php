<?php

namespace App\Models;

use App\Models\BarangModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiBarangItemModel extends Model
{
    protected $table = 'transaksi_barang_items';

    protected $fillable = ['id_transaksi_barang', 'id_barang', 'harga', 'stock', 'subtotal'];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(BarangModel::class, 'id_barang', 'id');
    }

    
}
