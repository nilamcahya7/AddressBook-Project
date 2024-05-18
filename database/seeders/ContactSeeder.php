<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Ensure at least 500 records are inserted
        for ($i = 0; $i < 500; $i++) {
            Contact::create([
                'name' => $faker->name,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'relationship' => $faker->randomElement(['Family', 'Friend', 'Colleague', 'Other']),
                'gender' => $faker->randomElement(['Male', 'Female', 'Other']),
                'status' => $faker->randomElement(['Active', 'Inactive']),
            ]);
        }
    }
}
