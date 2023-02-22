<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Navitem;
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

        \App\Models\User::factory()->create([
            'name' => 'Usuario Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Admin123'),
        ]);

        Navitem::factory()->create([
            'label' => __('Greetings'),
            'link' => '#greetings'
        ]);

        Navitem::factory()->create([
            'label' => __('Projects'),
            'link' => '#projects'
        ]);

        Navitem::factory()->create([
            'label' => __('Contact Me'),
            'link' => '#contact'
        ]);
    }
}
