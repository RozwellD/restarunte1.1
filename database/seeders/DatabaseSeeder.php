<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Puesto;
use App\Models\Sucursal;
use App\Models\User;
use App\Models\UserLaboral;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Puesto::factory()->create([
            'name' => 'Mesero',
            'slug' => 'waiter',
            'active' => true
        ]);

        Puesto::factory()->create([
            'name' => 'Cajero',
            'slug' => 'cashier',
            'active' => true
        ]);

        Puesto::factory()->create([
            'name' => 'Cocinero',
            'slug' => 'chef',
            'active' => true
        ]);

        Puesto::factory()->create([
            'name' => 'Administrador',
            'slug' => 'administrator',
            'active' => true
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@test.dev',
            'type' => 'root'
        ]);


        Sucursal::factory()->count(4)->create()->each(function (Sucursal $sucursal) {
            $puesto = Puesto::inRandomOrder()->where('slug', '!=', 'administrator')->first();
            User::factory(5)
                ->create([
                    'sucursal_id' => $sucursal->id,
                    'type' => $puesto->slug
                ])
                ->each(function (User $user) use ($puesto) {
                    UserLaboral::factory(1)->create([
                        'user_id' => $user->id,
                        'puesto_id' => $puesto->id
                    ]);
                });
        });
    }
}
