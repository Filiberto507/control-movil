<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoItem extends Model
{
    use HasFactory;
    protected $fillable=['item','descripcion','diagnosticos_id'];

    public function diagnostico()
    {
        
        return $this->belongsTo(Diagnostico::class);
 
    }
    
}
