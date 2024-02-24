<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\{ Org, Contact, Creator };

class OrgFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['FREE', 'PAID']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Org $org) {
            $org->contact()->save(Contact::factory()->make());
            $org->creator()->save(Creator::factory()->make());
        });
    }
}
