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
    public function barang()
    {
        return $this->hasOne(Barang::class, 'id', 'barang_id');
    }
    
    /**
     * The roles that belong to the BarangMasuk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function suply()
    {
        return $this->belongsToMany(Suply::class, SuplyBarang::class);
    }
}
