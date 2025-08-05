<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupplierModel extends Model
{
    protected $table = 'suppliers';

    protected $fillable = ['nama', 'alamat', 'kontak','waktu_tunggu'];

    public function barangs(): HasMany
    {
        return $this->hasMany(BarangModel::class, 'id_supplier', 'id');
    }
}
