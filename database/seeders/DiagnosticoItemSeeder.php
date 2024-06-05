<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DiagnosticoItem;
use App\Models\Taller;

class DiagnosticoItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i = 1; $i <= 40; $i++) {
            $palabras = [
                "BATERIA 70 AMP", "FAROLES", "FOCOS DE FAROL", "JUEGOS RETENES DE BOLON", "RODAMIENTO DE APOYO", "RETENES DE PALIER DELANTERO", "BUJES DE MUELLE", "SELENOIDE Y BENDIX",
                "FILTRO DE GASOLINA", "FILTRO DE ACEITE", "JUEGO DE PASTILLA", "JUEGO DE MUÑONES DE DIRECCION", "MANGUERA DE FRNO"
            ];
            $texto = $palabras;
            $tipo_taller = rand(1, 2);


            for ($j = 1; $j <= rand(1, 12); $j++) {
                $indiceAleatorio = array_rand($texto);

                // Obtener la palabra aleatoria
                $textoAleatorio = $texto[$indiceAleatorio];

                // Eliminar la palabra seleccionada de la lista
                
                DiagnosticoItem::create([
                    'item' => rand(1, 5),
                    'descripcion' => $textoAleatorio,
                    'diagnosticos_id' => $i
                ]);
                unset($texto[$indiceAleatorio]);
            }
        }
    }
}
