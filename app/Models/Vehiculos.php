<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    use HasFactory;

    protected $fillable=['placa','clase','marca','tipo_vehiculo','color','combustible_capacidad',
                         'motor','chasis','modelo','cilindrada','estado'];

    public function diagnostico()
    {
        
        return $this->belongsTo(Diagnostico::class);
 
    }
    public function diagnostico_area_transporte()
    {
        
        return $this->belongsTo(Diagnostico_area_transporte::class);
 
    }


    public function taller()
    {
        return $this->hasMany(taller::class);

    }

    public function controlmovil()
    {
        
        return $this->belongsTo(controlmovil::class);
 
    }

    

}
