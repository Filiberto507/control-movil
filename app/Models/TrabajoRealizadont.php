<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrabajoRealizadont extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_trabajo', 'vehiculo', 'placa', 'dependencia', 'responsable', 'km_ingreso', 'km_salida', 
        'fecha_ingreso','fecha_salida', 'descripcion', 'observaciones', 'diagnosticont_id'
     ];

     public function diagnostico()
    {
        return $this->hasMany(Diagnosticont::class);

    }
    
}
