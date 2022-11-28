<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    
    protected $table = 'barang';
    protected $guarded = ['id'];

   /**
     * Get the user that owns the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    /**
     * The roles that belong to the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function barangmasuk()
    {
        return $this->belongsTo(BarangMasuk::class, 'barang_id', 'id');
    }

    /**
     * Get the barangkeluar that owns the Barang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function barangkeluar()
    {
        return $this->belongsTo(BarangKeluar::class, 'barang_id', 'id');
    }
}
