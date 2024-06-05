<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrabajoRealizadoTaller extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_trabajo', 'vehiculo', 'placa', 'dependencia', 'responsable', 'km_ingreso', 'km_salida', 
        'fecha_ingreso','fecha_salida', 'descripcion', 'observaciones', 'taller_id'
     ];

     public function taller()
    {
        return $this->hasMany(Taller::class);

    }
}
