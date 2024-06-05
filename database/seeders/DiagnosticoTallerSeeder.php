<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Taller;
use App\Models\Diagnostico;

class DiagnosticoTallerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fechaIngreso = Carbon::parse('2023-02-26');
        $observacion='';
        for ($i = 1; $i <= 40; $i++) {
            $taller = Taller::find( $i);
            $responsable = $taller->responsable;
            $ingreso = $fechaIngreso->addWeek(); // Aumenta un día por cada iteración.
            $kilometraje = 3658 + ($i * 1000); // Aumenta 1000 km por cada iteración.
            $palabras = ["Cambio de aceite y mantenimiento", "Mantenimiento de las buguias", "cambio de aceite y otros", "Mantenimiento del muelle y frenos del vehiculo"];
            $textoAleatorio = $palabras[array_rand($palabras)];
                $tipo_taller = rand(1, 2);

            Diagnostico::create([ 
                'numero_diagnostico' => $i,
                'fecha' => $taller->fecha_ingreso,
                'dependencia' => $taller->dependencia,
                'conductor' => $taller->conductor,
                'tipo_taller' => $tipo_taller,
                'observacion' => $textoAleatorio,
                'responsable' => $responsable,
                'vehiculos_id' => $taller->vehiculo_id,
                'taller_id' => $taller->id      
            ]);
        }
    }
}
