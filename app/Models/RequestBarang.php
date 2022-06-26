<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestBarang extends Model
{
    use HasFactory;
    protected $table = 'request_barang';
    protected $guarded = ['id'];

    /**
     * Get all of the comments for the RequestBarang
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
