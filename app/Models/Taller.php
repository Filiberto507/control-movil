<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_taller','ingreso', 'salida', 'fecha_ingreso','fecha_salida', 'conductor','vehiculo','color',
       'dependencia', 'placa', 'kilometraje','ordentrabajo','responsable','vehiculo_id', 'clase', 'tipo_vehiculo'
    ];

    public function tallerdetalle()
    {
        return $this->hasMany(tallerdetalle::class);

    }

    public function vehiculos()
    {
        return $this->belongsTo(Vehiculos::class);

    }

    public function estadovehiculo()
    {
        return $this->hasMany(Estadovehiculo::class);

    }

    public function trabajoreazliado()
    {
        return $this->belongsTo(TrabajoRealizadoTaller::class);

    }

    public function diagnotico()
    {
        return $this->belongsTo(Diagnostico::class);

    }
    public function diagnostico_area_transporte()
    {
        return $this->belongsTo(Diagnostico_area_transporte::class);

    }
}
