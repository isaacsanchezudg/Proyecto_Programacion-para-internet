<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AlumnoFactory extends Factory
{
    public function definition()
    {
        $sexo = $this->faker->randomElement(['M', 'F']);
        $carreras = [
            'Ingeniería en Sistemas',
            'Medicina',
            'Derecho',
            'Administración',
            'Psicología',
            'Arquitectura',
            'Contaduría',
            'Ingeniería Civil'
        ];

        return [
            'codigo' => 'AL' . $this->faker->unique()->numberBetween(1000, 9999),
            'nombre' => $this->faker->name(),
            'correo' => $this->faker->unique()->safeEmail(),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
            'sexo' => $sexo,
            'carrera' => $this->faker->randomElement($carreras),
        ];
    }
}