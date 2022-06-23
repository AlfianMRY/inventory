<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $guarded = ['id'];

    /**
     * The roles that belong to the Supplier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function barangmasuk()
    {
        return $this->belongsToMany(BarangMasuk::class, 'barang_masuk', 'barang_id', 'supplier_id');
    }
}
