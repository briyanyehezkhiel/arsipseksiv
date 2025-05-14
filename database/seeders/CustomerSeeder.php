<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Gunakan data lokal Indonesia

        foreach (range(1, 100000) as $index) {
            Customer::create([
                'name' => $faker->name,
                'number' => $faker->phoneNumber,
                'address' => $faker->address,
                'gender' => $faker->randomElement(['Laki-laki', 'Perempuan']),
            ]);
        }
    }
}
