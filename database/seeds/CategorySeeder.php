<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = User::where('email', 'user@gmail.com')->first();
        $author2 = User::where('email', 'admin@gmail.com')->first();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $post = Category::create([
                'title' => $title,
                'description' => $faker->text($maxNbChars = 100),
                'status' => rand(0, 1),
                'user_id' => $author1->id
            ]);
            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $post = Category::create([
                'title' => $title,
                'description' => $faker->text($maxNbChars = 100),
                'status' => rand(0, 1),
                'user_id' => $author2->id
            ]);
        }
    }
}