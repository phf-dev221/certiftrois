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
            "categorie_id"=>2,
            "statut"=>fake()->randomElement(['en attente', 'accepte','refuse']),
            "user_id"=>15,
            "rendu"=>0
        ];
    }
}
