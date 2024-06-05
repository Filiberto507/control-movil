<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehiculos;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Vehiculos
        Vehiculos::create([   
            'placa' => '3453-CUX',
            'modelo' => '2014',
            'marca' => 'NISSAN',
            'clase' => 'VAGONETA',
            'tipo_vehiculo' => 'PATROL',
            'color' => 'BEIGE',
            
        ]);
        
        /*Vehiculos::create([   
            'placa' => '',
            'modelo' => '',
            'marca' => '',
            'color' => '',
            
        ]);

        Vehiculos::create([   
            'placa' => '',
            'modelo' => '',
            'marca' => '',
            'color' => '',
            
        ]);

        Vehiculos::create([   
            'placa' => '',
            'modelo' => '',
            'marca' => '',
            'color' => '',
            
        ]);*/
        //gabinete
        Vehiculos::create([   
            'placa' => '4756-YUH',
            'modelo' => '2018',
            'marca' => 'SUZUKI',
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'JIMNY',
            'color' => 'AZUL',
            
        ]);
        //ASESORIA DE GESTION INSTITUCIONAL Y RELACIONAMIENTO
        Vehiculos::create([   
            'placa' => '3453-CIP',
            'modelo' => '2013',
            'marca' => 'NISSAN',
            'clase' => 'VAGONETA',
            'tipo_vehiculo' => 'X-TRAIL',
            'color' => 'ROJO',
            
        ]);

        
    }
}
