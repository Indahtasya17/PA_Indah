<?php

namespace App\Models;

use App\Models\KonfirmasiMasuk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiBarangModel extends Model
{
    protected $table = 'transaksi_barangs';

    protected $fillable = ['id_user', 'tanggal', 'total_tagihan', 'no_polisi', 'tipe_transaksi', 'sumber_transaksi', 'kontak_supir', 'status'];

    public function items()
    {
        return $this->hasMany(TransaksiBarangItemModel::class, 'id_transaksi_barang', 'id');
    }

    public function riwayat_konfirmasi()
    {
        return $this->hasMany(KonfirmasiMasuk::class, 'id_transaksi_barang', 'id');
    }

    public function barang_import_masuk(): HasOne
    {
        return $this->hasOne(BarangImportMasukModel::class, 'id_transaksi_barang', 'id');
    }

    public function import_file(): HasOne
    {
        return $this->hasOne(ImportFileModel::class, 'id_transaksi_barang', 'id');
    }

    public function barang_keluar_customer(): HasOne
    {
        return $this->hasOne(BarangKeluarCustomerModel::class, 'id_transaksi_barang', 'id');
    }


    public function barang_masuk()
    {
        return $this->hasOne(BarangImportMasukModel::class, 'id_transaksi_barang');
    }

    public function file()
    {
        return $this->hasOne(FileModel::class, 'id_transaksi_barang');
    }


}

