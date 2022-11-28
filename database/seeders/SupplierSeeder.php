<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        for ($i=0; $i < 5; $i++) { 
            Supplier::create([
                'nama'=> $faker->word(),
                'no_hp'=>$faker->phoneNumber(),
                'keterangan'=>$faker->sentence(10),
            ]);
        }
    }
}
