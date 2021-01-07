<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'title' => Str::random(10),
            'body' => Str::random(30),
            'cover_image' => Str::random(10),
            'category_id' => rand(1, 4),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => Str::random(10),
            'body' => Str::random(30),
            'cover_image' => Str::random(10),
            'category_id' => rand(1, 4),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => Str::random(10),
            'body' => Str::random(30),
            'cover_image' => Str::random(10),
            'category_id' => rand(1, 4),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => Str::random(10),
            'body' => Str::random(30),
            'cover_image' => Str::random(10),
            'category_id' => rand(1, 4),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => Str::random(10),
            'body' => Str::random(30),
            'cover_image' => Str::random(10),
            'category_id' => rand(1, 4),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ],
        [
            'title' => Str::random(10),
            'body' => Str::random(30),
            'cover_image' => Str::random(10),
            'category_id' => rand(1, 4),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
