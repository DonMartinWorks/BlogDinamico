<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Navitem;
use App\Models\Project;
use App\Models\SocialLink;
use Illuminate\Database\Seeder;
use App\Models\PersonalInformation;

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
            'name' => 'Usuario Administrador Blog',
            'email' => 'blog@dinamico.com'
        ]);

        Navitem::factory()->create([
            'label' => __('Greetings'),
            'link' => __('#greetings')
        ]);

        Navitem::factory()->create([
            'label' => __('Projects'),
            'link' => __('#projects')
        ]);

        Navitem::factory()->create([
            'label' => __('Contact Me'),
            'link' => __('#contact')
        ]);

        //PersonalInformation
        PersonalInformation::factory()->create();

        //Project
        Project::factory(3)->create();

        //SocialLink
        SocialLink::factory()->create([
            'name' => 'Laravel',
            'url' => 'https://laravel.com/',
            'icon' => 'fa-brands fa-laravel',
        ]);

        SocialLink::factory()->create([
            'name' => 'Youtube',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'icon' => 'fa-brands fa-youtube',
        ]);
    }
}
