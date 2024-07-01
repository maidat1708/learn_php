<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            Article::create([
                "title"=> $faker->sentence(),
                'category_id' => $faker->numberBetween(1,10),
                'description' => $faker->paragraph(3),
                'author_id' => $faker->numberBetween(1,10),
            ]);

        }
    }
}
