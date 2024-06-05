<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;
    protected $fillable=['numero_diagnostico', 'fecha','dependencia','conductor', 'tipo_taller','observacion','responsable','vehiculos_id', 'taller_id'];
                        
    public function diagnosticoItem()
    {
        return $this->hasMany(DiagnosticoItem::class);

    }
    public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class);

    }
    
    public function taller()
    {
        return $this->hasMany(Taller::class);

    }
    
}
