<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuk';
    protected $guarded = ['id'];

    /**
     * Get all of the comments for the BarangMasuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }
    public function barang()
    {
        return $this->hasOne(Barang::class, 'id' , 'barang_id');
    }
}
