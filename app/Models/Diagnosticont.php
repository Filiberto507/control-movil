<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosticont extends Model
{
    use HasFactory;
    protected $fillable=['numero_diagnostico', 'fecha','dependencia','conductor', 'tipo_taller','observacion','responsable','vehiculos_id'];
                        
    public function diagnosticoItemnt()
    {
        return $this->hasMany(DiagnosticontItem::class);

    }
    public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class);

    }

    public function diagnostico_area_transportent()
    {
        return $this->belongsTo(DiagnosticoAreaTransportent::class);

    }

    public function trabajoreazliado()
    {
        return $this->belongsTo(TrabajoRealizadoTaller::class);

    }
}
