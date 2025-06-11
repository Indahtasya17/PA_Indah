<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelabuhanModel extends Model
{
    protected $table = 'pelabuhan';

    protected $fillable = ['id_barang', 'tanggal', 'no_container', 'no_polisi', 'jumlah_container', 'kontak','file','jumlah_barang',];

    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'id_barang');
    }
}

