<?php

namespace Database\Factories;

use App\Models\Credit;
use App\Models\Solde;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Remboursement>
 */
class RemboursementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'credit_id' => Credit::factory(),
            'designation' => $this->faker->text,
            'montant' => $this->faker->randomFloat(2, 0, 1000),
            'approuve' => $this->faker->boolean,
            'date_remboursement' => $this->faker->date,
            'feuille' => $this->faker->word,
            'solde_id'
        ];
    }
}
