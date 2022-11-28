<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama'=>$this->faker->word(),
            'kode'=>$this->faker->uniqid(),
            'kategori_id'=>$this->faker->numberBetween(1,10),
            'stock'=>$this->faker->numberBetween(20,500),
            
        ];
    }
}
