<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bien>
 */
class BienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "libelle"=> fake()->name(),
            "lieu"=> fake()->name(),
            "description"=> fake()->text(),
            "date"=> fake()->date(),
            "categorie_id"=>8,
            "statut"=>fake()->randomElement(['en attente', 'accepte','refuse']),
            "user_id"=>223,
            "estExpire"=>0,
            "type_bien"=>fake()->randomElement(['bien trouve', 'bien perdu'])
        ];
    }
}
