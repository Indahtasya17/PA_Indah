<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SortirModel extends Model
{
    protected $table = 'sortir';

    protected $fillable = ['id_barang','nama_barang','tanggal','jumlah_sortiran','satuan','jumlah_bagus','jumlah_busuk'];
}
