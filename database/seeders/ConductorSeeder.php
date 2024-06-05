<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Conductor;

class ConductorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //conductores

        //GOBERNACION
        Conductor::create([ 
            'name' => 'ROMAN TOMAS MATIAS',
            'ci'=>'6278234',
            'telefono' => '64585469',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'WILIAN SANCHEZ CABRERA',
            'ci'=>'65345234',
            'telefono' => '64585469',
            'status' => 'LOCKED',
        ]);
        //GABINETE
        Conductor::create([ 
            'name' => 'FRANKLIN VALLEJOS FERNANDEZ',
            'ci'=>'10232314',
            'telefono' => '75856545',
            'status' => 'ACTIVE',
        ]);
        //ASESORIA DE GESTION INSTITUCIONAL Y RELACIONAMIENTO
        Conductor::create([ 
            'name' => 'LUIS BRUNO MONTESINOS VARGAS',
            'ci'=>'72644234',
            'telefono' => '65369636',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'MACARIO MAMANI OLIVERA',
            'ci'=>'5762378',
            'telefono' => '65369637',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'RUBEN RODRIGUEZ CHOQUE',
            'ci'=>'10378234',
            'telefono' => '65369638',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'SAMUEL SANDOVAL BALDERRAMA',
            'ci'=>'58732889',
            'telefono' => '65369639',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'VICTOR GEMIO HERVAS',
            'ci'=>'87277878',
            'telefono' => '65369640',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'RENE TOLA COLQUE',
            'ci'=>'62734234',
            'telefono' => '65369641',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'AMILCAR DAZA OJEDA',
            'ci'=>'88778322',
            'telefono' => '65369642',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'SIXTO MAMANI TOLA',
            'ci'=>'10234454',
            'telefono' => '65369643',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'JOSE LUIS HIDALGO',
            'ci'=>'62786712',
            'telefono' => '65369644',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'ALEX ARCE',
            'ci'=>'78278234',
            'telefono' => '65369645',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'RODRIGO SANCHEZ',
            'ci'=>'65578234',
            'telefono' => '65369646',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'ARTURO PAREDES OSORIO',
            'ci'=>'76278234',
            'telefono' => '65369647',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'JUAN VILLCA CARI',
            'ci'=>'86278234',
            'telefono' => '65369648',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'MAURICIO TORRICO',
            'ci'=>'10278234',
            'telefono' => '65369649',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'ALVARO PEREDO LOPEZ',
            'ci'=>'5458234',
            'telefono' => '65369650',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'WALTER CHOQUE TOCO',
            'ci'=>'76578234',
            'telefono' => '65369651',
            'status' => 'ACTIVE',
        ]);

        Conductor::create([ 
            'name' => 'GUSTAVO MELENDES CAMACHO',
            'ci'=>'9627334',
            'telefono' => '65369652',
            'status' => 'ACTIVE',
        ]);
    }
}
