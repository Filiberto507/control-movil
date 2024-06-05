<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ModelHasRoles;

class ModelHasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ModelHasRoles
        ModelHasRoles::create([     
            'role_id' => 1, 
            'model_type' => 'App\Models\User',
            'model_id' => 1,
        ]);

        


    }
}
