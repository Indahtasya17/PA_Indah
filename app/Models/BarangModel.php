<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'waktu_tunggu',
        'sumber',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(SupplierModel::class, 'id_supplier', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransaksiBarangItemModel::class, 'id_barang', 'id');
    }
}
