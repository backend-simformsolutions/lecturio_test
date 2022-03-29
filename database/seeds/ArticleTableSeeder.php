<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,5) as $index){
            \DB::table('books')->insert([
                'title' => $faker->company,
                'isbn' => $faker->regexify('[A-Za-z0-9]{8}'),
                'author' => $faker->firstName,
                'category' => $faker->name,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }

        foreach (range(1,3) as $index){
            \DB::connection('mysql2')->table('books')->insert([
                'title' => $faker->company,
                'isbn' => $faker->regexify('[A-Za-z0-9]{8}'),
                'author' => $faker->firstName,
                'category' => $faker->name,
                'created_at' => $faker->dateTime(),
                'updated_at' => $faker->dateTime()
            ]);
        }
    }
}
