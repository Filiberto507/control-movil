<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticoAreaTransportent extends Model
{
    use HasFactory;
    protected $fillable=['numero_diagtransporte', 'fecha','conclusion','dependencia','conductor', 'tipo_taller', 'vehiculos_id','diagnosticont_id'];

    public function diagnostico_serviciont()
    {
        return $this->hasMany(DiagnosticoServiciont::class);

    }
    public function diagnostico_obrant()
    {
        return $this->hasMany(DiagnosticoObrant::class);

    }
    public function vehiculos()
    {
        return $this->hasMany(Vehiculos::class);

    }

    public function diagnosticont()
    {
        return $this->hasMany(Diagnosticont::class);

    }
}
