<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadovehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion', 'key', 'taller_id'
     ];

     public function taller()
    {
        return $this->belongsTo(Taller::class);

    }
}
