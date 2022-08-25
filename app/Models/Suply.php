<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suply extends Model
{
    use HasFactory;
    protected $table = 'suply';
    protected $guarded = ['id'];

    /**
     * Get the user that owns the Suply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    /**
     * The roles that belong to the Suply
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function barangMasuk()
    {
        return $this->belongsToMany(BarangMasuk::class, SuplyBarang::class);
    }
}
