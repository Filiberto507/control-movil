<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoObra extends Model
{
    use HasFactory;
    protected $fillable=['item','cantidad','servicio','diagnostico_area_transportes_id'];

    public function diagnostico_area_transporte()
    {
        
        return $this->belongsTo(DiagnosticoAreaTransporte::class);
 
    }
    
}
