<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        if (! $admin) {
            return;
        }

        $posts = [
            [
                'title' => 'Getting Started with Strength Training',
                'slug' => 'getting-started-strength-training',
                'body' => 'Strength training is one of the most effective ways to improve your overall health and fitness. Whether you are a beginner or an experienced lifter, understanding the fundamentals is key to making consistent progress...',
                'excerpt' => 'Learn the fundamentals of strength training for beginners.',
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'The Importance of Nutrition in Fitness',
                'slug' => 'importance-nutrition-fitness',
                'body' => 'You cannot out-train a bad diet. Nutrition plays a critical role in your fitness journey, affecting everything from energy levels to recovery. In this post, we will explore the key nutritional principles...',
                'excerpt' => 'Why what you eat matters more than how you train.',
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Top 5 Supplements for Muscle Growth',
                'slug' => 'top-5-supplements-muscle-growth',
                'body' => 'While whole foods should always be your primary source of nutrients, certain supplements can help accelerate your muscle-building efforts. Here are the top 5 supplements backed by science...',
                'excerpt' => 'Evidence-based supplements to support your gains.',
                'published_at' => now()->subDays(2),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create([
                ...$post,
                'user_id' => $admin->id,
            ]);
        }
    }
}
