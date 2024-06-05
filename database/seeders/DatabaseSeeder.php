<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(ModelHasRolesSeeder::class);
        $this->call(RoleHasPermissionSeeder::class);
        $this->call(AccesoriostallerSeeder::class);
        $this->call(DependenciaSeeder::class);
        $this->call(VehiculoSeeder::class);
        $this->call(ConductorSeeder::class);
        $this->call(TallerSeeder::class);
        $this->call(TallerDetallerSeeder::class);
        $this->call(EstadoVehiculoSeeder::class);
        $this->call(DiagnosticoTallerSeeder::class);
        $this->call(DiagnosticoItemSeeder::class);
    }
}
