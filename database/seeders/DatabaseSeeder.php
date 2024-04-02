<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Article::factory()->count(20)->create();
        Comment::factory()->count(40)->create();

        $list = ['News','Tech','Diary','Beauty'];
        foreach($list as $name){
            Category::create(['name' => $name]);
        }

        User::factory()->create([
            "name" => "mg mg",
            "email" => "mg@gmail.com"
        ]);

        User::factory()->create([
            "name" => "min min",
            "email" => "min@gmail.com"
        ]);

    }
}
