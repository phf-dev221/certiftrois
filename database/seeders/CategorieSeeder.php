<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorie::create([
            "nom" => "Papeterie",

        ]);

        Categorie::create([
            "nom" => "Clés",

        ]);

        Categorie::create([
            "nom" => "Sac",

        ]);

        Categorie::create([
            "nom" => "Portefeuille",

        ]);

        Categorie::create([
            "nom" => "Appareil électronique",

        ]);
    }
}
