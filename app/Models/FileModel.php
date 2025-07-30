<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    //mendefinisakn nama tabel
    protected $table = 'files';

    protected $fillable = ['id_transaksi_barang','file'];
}
