<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    protected $table = 'files';

    protected $fillable = ['id_transaksi_barang','file'];
}
