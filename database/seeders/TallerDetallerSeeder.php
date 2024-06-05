<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tallerdetalle;

class TallerDetallerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //accesorios detalles

        for($i = 1; $i <=40; $i++)
        {

            for($j = 1; $j <=rand(8,25); $j++)
            {   
                
                tallerdetalle::create([ 
                    'acctaller_id' => rand(1,30),
                    'taller_id' => $i,       
                ]);
            }
        }




       /* tallerdetalle::create([ 
            'acctaller_id' => 1,
            'taller_id' => 1,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 4,
            'taller_id' => 1,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 7,
            'taller_id' => 1,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 8,
            'taller_id' => 1,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 5,
            'taller_id' => 1,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 32,
            'taller_id' => 1,       
        ]);

        tallerdetalle::create([ 
            'acctaller_id' => 2,
            'taller_id' => 2,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 4,
            'taller_id' => 2,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 5,
            'taller_id' => 2,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 15,
            'taller_id' => 2,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 21,
            'taller_id' => 2,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 22,
            'taller_id' => 2,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 24,
            'taller_id' => 2,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 35,
            'taller_id' => 2,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 11,
            'taller_id' => 2,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 17,
            'taller_id' => 2,       
        ]);
        tallerdetalle::create([ 
            'acctaller_id' => 27,
            'taller_id' => 2,       
        ]);*/
    }
}
