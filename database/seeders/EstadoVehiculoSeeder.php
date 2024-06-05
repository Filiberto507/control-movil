<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estadovehiculo;

class EstadoVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //estado de vehiculo

        Estadovehiculo::create([ 
            'descripcion' => 'roto',
            'key' => 0,  
            'taller_id' => 1,     
        ]);
        Estadovehiculo::create([ 
            'descripcion' => 'nuevo',
            'key' => 6,  
            'taller_id' => 1,     
        ]);

        Estadovehiculo::create([ 
            'descripcion' => 'dañado',
            'key' => 0,  
            'taller_id' => 2,     
        ]);
        Estadovehiculo::create([ 
            'descripcion' => 'roto',
            'key' => 2,  
            'taller_id' => 2,     
        ]);
        Estadovehiculo::create([ 
            'descripcion' => 'perdido',
            'key' => 3,  
            'taller_id' => 2,     
        ]);
        Estadovehiculo::create([ 
            'descripcion' => 'falta',
            'key' => 6,  
            'taller_id' => 2,     
        ]);

    }
}
