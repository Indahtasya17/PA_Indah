<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangModel extends Model
{
    protected $table = 'barangs';

    protected $fillable = [
        'id_supplier',
        'nama_barang',
        'kode_barang',
        'harga_beli',
        'harga_jual',
        'stok',
        'minimum_stok',
        'satuan',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(SupplierModel::class, 'id_supplier', 'id');
    }
}
