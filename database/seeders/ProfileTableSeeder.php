<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        for($i = 0 ; $i < 5; $i++){
            Profile::create([
                'name' => $faker->sentence(2,false),
                'dob' => $faker->dateTimeBetween('2002-01-01', '2002-12-31'),
                'numberPhone'=> $faker-> phoneNumber(),
                'address' => $faker->address(),
                'user_id' => $i+1,
            ]);
        }
    }
}
