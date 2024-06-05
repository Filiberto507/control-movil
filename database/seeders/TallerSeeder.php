<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Taller;

class TallerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            
        //1
        //taller 
        
        $fechaIngreso = Carbon::parse('2023-02-26');
        $fechaIngreso2 = Carbon::parse('2023-03-03');
        $c=1;
        $c2=2;
        for ($i = 0; $i < 20; $i++) {
            $ingreso = $fechaIngreso->addWeek(); // Aumenta un día por cada iteración.
            $ingreso2 = $fechaIngreso2->addWeek();
            $kilometraje = 3658 + ($i * 1000); // Aumenta 1000 km por cada iteración.
            if($i > 8)
            {
                $conductor = 'GUSTAVO MELENDES CAMACHO';
            }
            else{
                $conductor = 'LUIS BRUNO MONTESINOS VARGAS';
            }

            
            Taller::create([ 
                'numero_taller' => $c,
                'ingreso' => '09:35',
                'fecha_ingreso' => $ingreso->format('Y-m-d'), // Formato de fecha 'YYYY-MM-DD'.
                'conductor' => $conductor,
                'vehiculo' => 'NISSAN',
                'color' => 'ROJO',
                'dependencia' => 'GABINETE',
                'placa' => '3453-CIP',
                'kilometraje' => $kilometraje,
                'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
                'responsable' => 'RODRIGO SANCHEZ GAMBOA',
                'vehiculo_id' => 3,
                'clase' => 'JEEP',
                'tipo_vehiculo' => 'MAZDA',          
            ]);

            Taller::create([ 
                'numero_taller' => $c2,
                'ingreso' => '18:44',
                'fecha_ingreso' => $ingreso2->format('Y-m-d'),
                'conductor' => 'ROMAN TOMAS MATIAS',
                'vehiculo' => 'SUZUKI',
                'color' => 'AZUL',
                'dependencia' => 'GOBERNACION',
                'placa' => '4756-YUH',
                'kilometraje' => $kilometraje,
                'ordentrabajo' => 'Refacciones a realizar
                cambio de aceite',
                'responsable' => 'SERGIO PINTO LACATO',
                'vehiculo_id' => 2,
                'clase' => 'VAGONETA',
                'tipo_vehiculo' => 'PATROL',         
            ]);
            $c = $c+2;
            $c2= $c2+2;
        }

        




















        /*//2
        Taller::create([ 
            'ingreso' => '17:35',
            'fecha_ingreso' => '2023-04-03',
            'conductor' => 'LUIS BRUNO MONTESINOS VARGAS',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //3
        Taller::create([ 
            'ingreso' => '10:35',
            'fecha_ingreso' => '2023-04-21',
            'conductor' => 'LUIS BRUNO MONTESINOS VARGAS',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //4
        Taller::create([ 
            'ingreso' => '12:05',
            'fecha_ingreso' => '2023-05-05',
            'conductor' => 'WILIAN SANCHEZ CABRERA',
            'vehiculo' => 'SUZUKI',
            'color' => 'AZUL',
            'dependencia' => 'GOBERNACION',
            'placa' => '4756-YUH',
            'kilometraje' => '1751',
            'ordentrabajo' => 'Refacciones a realizar
            cambio de aceite',
            'vehiculo_id' => 2,
            'clase' => 'VAGONETA',
            'tipo_vehiculo' => 'PATROL',         
        ]);

        //5
        Taller::create([ 
            'ingreso' => '17:35',
            'fecha_ingreso' => '2023-05-01',
            'conductor' => 'LUIS BRUNO MONTESINOS VARGAS',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //6
        Taller::create([ 
            'ingreso' => '14:35',
            'fecha_ingreso' => '2023-05-10',
            'conductor' => 'GUSTAVO MELENDES CAMACHO',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //7
        Taller::create([ 
            'ingreso' => '12:35',
            'fecha_ingreso' => '2023-05-18',
            'conductor' => 'GUSTAVO MELENDES CAMACHO',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //8
        Taller::create([ 
            'ingreso' => '13:35',
            'fecha_ingreso' => '2023-06-17',
            'conductor' => 'GUSTAVO MELENDES CAMACHO',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //9
        Taller::create([ 
            'ingreso' => '09:35',
            'fecha_ingreso' => '2023-06-26',
            'conductor' => 'GUSTAVO MELENDES CAMACHO',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //10
        Taller::create([ 
            'ingreso' => '14:35',
            'fecha_ingreso' => '2023-07-04',
            'conductor' => 'GUSTAVO MELENDES CAMACHO',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //11
        Taller::create([ 
            'ingreso' => '17:35',
            'fecha_ingreso' => '2023-07-11',
            'conductor' => 'GUSTAVO MELENDES CAMACHO',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //1
        Taller::create([ 
            'ingreso' => '17:35',
            'fecha_ingreso' => '2023-07-11',
            'conductor' => 'LUIS BRUNO MONTESINOS VARGAS',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //1
        Taller::create([ 
            'ingreso' => '17:35',
            'fecha_ingreso' => '2023-07-11',
            'conductor' => 'LUIS BRUNO MONTESINOS VARGAS',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //1
        Taller::create([ 
            'ingreso' => '17:35',
            'fecha_ingreso' => '2023-07-11',
            'conductor' => 'LUIS BRUNO MONTESINOS VARGAS',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);

        //1
        Taller::create([ 
            'ingreso' => '17:35',
            'fecha_ingreso' => '2023-07-11',
            'conductor' => 'LUIS BRUNO MONTESINOS VARGAS',
            'vehiculo' => 'NISSAN',
            'color' => 'ROJO',
            'dependencia' => 'GABINETE',
            'placa' => '3453-CIP',
            'kilometraje' => '3658',
            'ordentrabajo' => 'Refacciones a realizar de las llantas y ventanas',
            'vehiculo_id' => 3,
            'clase' => 'JEEP',
            'tipo_vehiculo' => 'MAZDA',          
        ]);*/
    }
}
