<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MitraModel extends Model
{

    protected $table = 'mitras'; // nama tabel

    protected $fillable = [
        'nama',
        'kontak',
        'alamat',
    ];

}
