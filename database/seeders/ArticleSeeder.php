<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker=Faker::create();
       
        for($i=0;$i<4;$i++){ 
            $title =$faker->sentence(6);
            DB::table('articles')->insert([
                'category' => rand(1, 7),
                'title' => $title,
                'image' => $faker->imageUrl($width = 640, $height = 480,'cats', true, 'Faker'),
                'content' => $faker->paragraph(6),
                'slug' => \Str::slug($title),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
