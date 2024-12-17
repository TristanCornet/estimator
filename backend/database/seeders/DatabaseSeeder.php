<?php

namespace Database\Seeders;

use App\Models\Estimate;
use App\Models\EstimateField;
use App\Models\EstimateLine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        EstimateField::factory()->create([
            'name' => 'Nom du projet',
            'slug' => Str::slug('Nom du projet'),
            'type' => 'Name'
        ]);

        EstimateField::factory()->create([
            'name' => 'Stack technique',
            'slug' => Str::slug('Stack technique'),
            'type' => 'Specification'
        ])
            ->values()->createMany([
                [
                    'label' => 'Laravel',
                    'value' => 'laravel',
                    'startup_time' => 4 * 60,
                    'total_percentage' => 0
                ],
                [
                    'label' => 'Laravel + VueJS',
                    'value' => Str::slug('Laravel + VueJS'),
                    'startup_time' => 6 * 60,
                    'total_percentage' => 25
                ]
            ]);

        EstimateField::factory()->create([
            'name' => 'Développements génériques',
            'slug' => Str::slug('Développements génériques'),
            'type' => 'Generic'
        ])
            ->values()->createMany([
                [
                    'label' => "Page d'accueil",
                    'value' => Str::slug("Page d'accueil"),
                    'time' => 7 * 60,
                ],
                [
                    'label' => "Événement",
                    'value' => Str::slug("Événement"),
                    'time' => 14 * 60,
                ],
                [
                    'label' => "Page de type éditoriale",
                    'value' => Str::slug("Page de type éditoriale"),
                    'time' => 5 * 60,
                ],
                [
                    'label' => "Offres d'emplois",
                    'value' => Str::slug("Offres d'emplois"),
                    'time' => 16 * 60,
                ],
                [
                    'label' => "Blog",
                    'value' => Str::slug("Blog"),
                    'time' => 10 * 60,
                ],
            ]);

        EstimateField::factory()->create([
            'name' => 'Développements supplémentaires',
            'slug' => Str::slug('Développements supplémentaires'),
            'type' => 'Additional'
        ]);

        EstimateField::factory()->create([
            'name' => 'Type de design',
            'slug' => Str::slug('Type de design'),
            'type' => 'Specification'
        ])
            ->values()->createMany([
                [
                    'label' => 'Simple',
                    'value' => Str::slug('Simple'),
                    'total_percentage' => 0,
                ],
                [
                    'label' => 'Complexe',
                    'value' => Str::slug('Complexe'),
                    'total_percentage' => 15,
                ],
                [
                    'label' => 'Complexe avec animations',
                    'value' => Str::slug('Complexe avec animations'),
                    'total_percentage' => 20,
                ]
            ]);
    }
}
