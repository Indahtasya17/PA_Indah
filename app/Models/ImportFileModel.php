<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportFileModel extends Model
{
    protected $table = 'import_files';

    protected $fillable = ['id_transaksi_barang', 'invoice', 'tanggal', 'file'];
}
