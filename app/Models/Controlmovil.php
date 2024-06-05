<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controlmovil extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehiculo', 'placa', 'dependencia', 'mes', 'conductor',
        'hora_salida','hora_retorno','fecha',
        'km_salida', 'km_regreso', 
         'combustible', 'tipo_destino', 'firma','vehiculo_id'
     ];

     public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class);

    }
}
