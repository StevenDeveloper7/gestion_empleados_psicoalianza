<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ciudad;

class CiudadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_ciudad' => $this->faker->firstName(),
            'id_pais' => $this->faker->randomElement(['1', '2', '3', '4','5'])
        ];
    }
}
