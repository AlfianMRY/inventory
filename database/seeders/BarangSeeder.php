<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Barang;
use Illuminate\Support\Str;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i = 0; $i < 1000; $i++) { 
            Barang::create(
                ['nama'=>$faker->word(),
                'kode'=>Str::random(10),
                'kategori_id' =>$faker->numberBetween(1,10),
                'stock'=>$faker->numberBetween(20,500),
                'foto'=>'default.jpg'
                ]
            );
        }
    }
}
