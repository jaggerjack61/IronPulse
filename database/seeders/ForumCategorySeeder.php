<?php

namespace Database\Seeders;

use App\Models\ForumCategory;
use Illuminate\Database\Seeder;

class ForumCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'General Discussion',
                'slug' => 'general-discussion',
                'description' => 'Talk about anything fitness related.',
                'icon' => 'chat-bubble-left-right',
                'sort_order' => 1,
            ],
            [
                'name' => 'Workout Routines',
                'slug' => 'workout-routines',
                'description' => 'Share and discuss workout plans.',
                'icon' => 'bolt',
                'sort_order' => 2,
            ],
            [
                'name' => 'Nutrition & Diet',
                'slug' => 'nutrition-diet',
                'description' => 'Meal plans, macros, and diet advice.',
                'icon' => 'fire',
                'sort_order' => 3,
            ],
            [
                'name' => 'Supplements',
                'slug' => 'supplements',
                'description' => 'Discuss supplements and their effects.',
                'icon' => 'clipboard-document-list',
                'sort_order' => 4,
            ],
            [
                'name' => 'Progress Logs',
                'slug' => 'progress-logs',
                'description' => 'Share your transformation journey.',
                'icon' => 'arrow-trending-up',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            ForumCategory::create($category);
        }
    }
}
