<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SortirsModel extends Model
{
    protected $table = 'sortirs';

    protected $fillable = ['id_barang','tanggal','jumlah_sortiran','satuan','jumlah_bagus','jumlah_busuk'];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(BarangModel::class, 'id_barang');
    }
    
}
