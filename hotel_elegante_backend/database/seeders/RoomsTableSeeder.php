<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 10) as $index) {
            DB::table('rooms')->insert([
                'type' => $faker->randomElement(['singola', 'doppia', 'suite']),
                'price' => $this->generateRealisticPrice(),
                'is_available' => $faker->boolean(80), // 80% di probabilità che la camera sia disponibile
            ]);
        }
    }

    
/**
 * Generate a realistic price for a 5-star hotel room.
 *
 * @return float
 */
    private function generateRealisticPrice()
    {
        $typePrices = [
            'singola' => [250, 350],
            'doppia' => [350, 500],
            'suite' => [600, 1000],
        ];

        $type = array_rand($typePrices);
        return number_format(rand($typePrices[$type][0], $typePrices[$type][1]), 2, '.', '');
    }

}
