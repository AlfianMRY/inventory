<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestSuplyBarang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'request_suply_barang';


    /**
     * Get all of the barangkeluar for the RequestSuplyBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barangkeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'request_suply_barang_id', 'id');
    }
    /**
     * Get the user that owns the RequestSuplyBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
