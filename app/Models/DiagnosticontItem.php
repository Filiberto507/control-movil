<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticontItem extends Model
{
    use HasFactory;
    protected $fillable=['item','descripcion','diagnosticosnt_id'];

    public function diagnostico()
    {
        
        return $this->belongsTo(Diagnosticont::class);
 
    }
}
