<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportFileModel extends Model
{
    protected $table = 'import_files';

    protected $fillable = [
        'id_transaksi_barang',
        'tanggal',
        'sales_contract',
        'invoice',
        'packing_list',
        'bill_of_loading',
        'phytosanitary_certificate',
        'health_certificate',
        'fumigation_certificate',
        'certificate_of_origin',
        'prior_notice',
        'insurance',
    ];
}
