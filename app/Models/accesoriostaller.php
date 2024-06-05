<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accesoriostaller extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function accesoriostaller()
    {
        return $this->hasMany(accesoriostaller::class);

    }
}

