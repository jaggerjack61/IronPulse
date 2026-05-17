<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\ForumCategory;
use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ForumCategorySeeder::class,
            BlogPostSeeder::class,
        ]);
    }
}
