<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Faker\Factory;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        for ($i=1; $i < 11; $i++) { 
            Kategori::create([
                'nama'=>$faker->word()
            ]);
        }
    }
}
