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
    * Get all of the comments for the Supplier
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function suply()
   {
       return $this->hasMany(Suply::class, 'supplier_id', 'id');
   }
}
