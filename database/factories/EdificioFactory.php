<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EdificioFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre' => 'Edificio ' . $this->faker->word(),
            'direccion' => $this->faker->address(),
            'pisos' => $this->faker->numberBetween(1, 10),
        ];
    }
}