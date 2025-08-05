<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangModel extends Model
{
    //mendefinisikan nama tabel
    protected $table = 'barangs';

    //mengatur kolom yang bisa diisi
    protected $fillable = [
        'id_supplier',
        'nama_barang',
        'kode_barang',
        'harga_beli',
        'harga_jual',
        'stok',
        'sumber',
    ];

    //tabel baraang beralasi one to one dengan supplier
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(SupplierModel::class, 'id_supplier', 'id');
    }

    // tabel barang beralasi one to many dengan transaksi barang
    public function items(): HasMany
    {
        return $this->hasMany(TransaksiBarangItemModel::class, 'id_barang', 'id');
    }
}
