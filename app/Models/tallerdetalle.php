<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tallerdetalle extends Model
{
    use HasFactory;
    protected $fillable = [
        'acctaller_id','taller_id',
    ];
    
    public function acctaller()
     {
         return $this->belongsTo(accesoriostaller::class);
 
     }
     public function taller()
     {
         return $this->belongsTo(Taller::class);
 
     }
}
