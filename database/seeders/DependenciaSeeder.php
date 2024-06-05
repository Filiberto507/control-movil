<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dependencia;

class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //dependencia
        Dependencia::create([   
            'nombre' => 'GOBERNADOR',
        ]);

        Dependencia::create([   
            'nombre' => 'GABINETE',
        ]);

        Dependencia::create([   
            'nombre' => 'ASESORIA DE GESTION INSTITUCIONAL Y RELACIONAMIENTO',
        ]);

        Dependencia::create([   
            'nombre' => 'DIRECCION JURIDICA',
        ]);
    }
}
