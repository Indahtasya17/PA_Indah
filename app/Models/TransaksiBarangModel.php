<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransaksiBarangModel extends Model
{
    protected $table = 'transaksi_barangs';

    protected $fillable = ['id_user', 'tanggal', 'total_tagihan', 'no_polisi', 'tipe_transaksi', 'sumber_transaksi'];

    public function items()
    {
        return $this->hasMany(TransaksiBarangItemModel::class, 'id_transaksi_barang', 'id');
    }

    public function barang_import_masuk(): HasOne
    {
        return $this->hasOne(BarangImportMasukModel::class, 'id_transaksi_barang', 'id');
    }

    public function barang_keluar_customer(): HasOne
    {
        return $this->hasOne(BarangKeluarCustomerModel::class, 'id_transaksi_barang', 'id');
    }

}

