<?php

namespace Tests\Feature;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ForumController;
use App\Models\BlogPost;
use App\Models\ForumCategory;
use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ContentRouteProtectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_blog_show_does_not_render_drafts_or_future_posts(): void
    {
        $author = User::factory()->create();
        $draft = $this->createBlogPost($author, 'draft-post', null);
        $futurePost = $this->createBlogPost($author, 'future-post', now()->addDay());

        $this->get(route('blog.show', $draft->slug))->assertNotFound();
        $this->get(route('blog.show', $futurePost->slug))->assertNotFound();
    }

    public function test_forum_post_urls_are_scoped_to_their_category(): void
    {
        $author = User::factory()->create();
        $firstCategory = $this->createCategory('training');
        $secondCategory = $this->createCategory('nutrition');
        $post = $this->createForumPost($author, $secondCategory, 'protein-plan');

        $this->get(route('forums.show', [$firstCategory->slug, $post->slug]))->assertNotFound();
    }

    public function test_forum_show_counts_one_view_per_page_load(): void
    {
        $author = User::factory()->create();
        $category = $this->createCategory('programming');
        $post = $this->createForumPost($author, $category, 'four-day-split');

        $this->get(route('forums.show', [$category->slug, $post->slug]))->assertOk();

        $this->assertSame(1, $post->refresh()->views_count);
    }

    public function test_blog_index_controller_defers_post_queries_to_livewire(): void
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        app(BlogController::class)->index();

        $this->assertSame([], DB::getQueryLog());
    }

    public function test_forum_index_controller_defers_category_queries_to_livewire(): void
    {
        DB::flushQueryLog();
        DB::enableQueryLog();

        app(ForumController::class)->index();

        $this->assertSame([], DB::getQueryLog());
    }

    public function test_forum_category_controller_defers_post_queries_to_livewire(): void
    {
        $category = $this->createCategory('mobility');

        DB::flushQueryLog();
        DB::enableQueryLog();

        app(ForumController::class)->category($category);

        $this->assertSame([], DB::getQueryLog());
    }

    private function createBlogPost(User $author, string $slug, mixed $publishedAt): BlogPost
    {
        return BlogPost::create([
            'user_id' => $author->id,
            'title' => str($slug)->replace('-', ' ')->title()->toString(),
            'slug' => $slug,
            'body' => 'A focused training article.',
            'published_at' => $publishedAt,
        ]);
    }

    private function createCategory(string $slug): ForumCategory
    {
        return ForumCategory::create([
            'name' => str($slug)->replace('-', ' ')->title()->toString(),
            'slug' => $slug,
        ]);
    }

    private function createForumPost(User $author, ForumCategory $category, string $slug): ForumPost
    {
        return ForumPost::create([
            'user_id' => $author->id,
            'forum_category_id' => $category->id,
            'title' => str($slug)->replace('-', ' ')->title()->toString(),
            'slug' => $slug,
            'body' => 'A focused forum post.',
        ]);
    }
}
