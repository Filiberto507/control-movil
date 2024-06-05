<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoServiciont extends Model
{
    use HasFactory;
    protected $fillable=['item','cantidad', 'unidad', 'servicio','diagnostico_area_transportent_id'];

    public function diagnostico_area_transportent()
    {
        
        return $this->belongsTo(DiagnosticoAreaTransportent::class);
 
    }
}
