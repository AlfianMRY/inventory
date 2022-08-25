<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuplyBarang extends Model
{
    use HasFactory;
    protected $table = 'suply_barang';
    protected $guarded = ['id'];

    /**
     * Get all of the barang for the SuplyBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barang()
    {
        return $this->hasMany(Barang::class, 'barang_id', 'id');
    }
}
