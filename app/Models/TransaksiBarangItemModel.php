<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiBarangItemModel extends Model
{
    protected $table = 'transaksi_barang_items';

    protected $fillable = ['id_transaksi_barang', 'id_barang', 'harga', 'stock', 'subtotal'];
}
