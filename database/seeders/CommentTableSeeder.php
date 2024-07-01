<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        for($i = 0 ; $i < 200; $i++){
            Comment::create([
                'title' => $faker->title(),
                'description' => $faker->paragraph(2,true),
                'post_id' => $faker->numberBetween(0,49)
            ]);
        }
    }
}
