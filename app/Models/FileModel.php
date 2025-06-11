<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    protected $table = 'file';

    protected $fillable = ['id_transaksi_barang','file'];
}
