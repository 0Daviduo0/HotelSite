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

        foreach(range(1, 100) as $index) {
            $type = $faker->randomElement(['singola', 'doppia', 'suite']);
            $price = $this->generateRealisticPrice($type);

            DB::table('rooms')->insert([
                'type' => $type,
                'price' => $price,
                'is_available' => $faker->boolean(80),
            ]);

        }
    }

    
/**
 * Generate a realistic price for a 5-star hotel room.
 *
 * @return float
 */
    private function generateRealisticPrice($type)
    {
        $typePrices = [
            'singola' => 350,
            'doppia' => 500,
            'suite' => 1000,
        ];

        return number_format($typePrices[$type], 2, '.', '');
    }


}
