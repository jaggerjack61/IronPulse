<?php

namespace Tests\Feature;

use App\Livewire\Blog\Show as BlogShow;
use App\Livewire\Components\CommentSection;
use App\Livewire\Forum\Category as ForumCategoryComponent;
use App\Livewire\Forum\Post as ForumPostComponent;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\ForumCategory;
use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LivewireWriteAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_create_forum_posts_directly(): void
    {
        $category = $this->createCategory('strength');

        Livewire::test(ForumCategoryComponent::class, ['category' => $category])
            ->set('title', 'Best squat cues')
            ->set('body', 'What cue helped your squat most?')
            ->call('createPost')
            ->assertForbidden();

        $this->assertDatabaseCount('forum_posts', 0);
    }

    public function test_guests_cannot_comment_on_blog_posts_directly(): void
    {
        $post = $this->createBlogPost();

        Livewire::test(BlogShow::class, ['post' => $post])
            ->set('commentBody', 'Great article.')
            ->call('addComment')
            ->assertForbidden();

        $this->assertDatabaseCount('comments', 0);
    }

    public function test_guests_cannot_comment_on_forum_posts_directly(): void
    {
        $category = $this->createCategory('conditioning');
        $post = $this->createForumPost($category);

        Livewire::test(ForumPostComponent::class, ['post' => $post])
            ->set('commentBody', 'Try tempo intervals.')
            ->call('addComment')
            ->assertForbidden();

        $this->assertDatabaseCount('comments', 0);
    }

    public function test_guests_cannot_reply_to_comments_directly(): void
    {
        $comment = $this->createComment();

        Livewire::test(CommentSection::class, ['comment' => $comment])
            ->set('replyBody', 'Helpful point.')
            ->call('addReply')
            ->assertForbidden();

        $this->assertDatabaseCount('comments', 1);
    }

    private function createBlogPost(): BlogPost
    {
        $author = User::factory()->create();

        return BlogPost::create([
            'user_id' => $author->id,
            'title' => 'Published Training Notes',
            'slug' => 'published-training-notes',
            'body' => 'A focused training article.',
            'published_at' => now()->subDay(),
        ]);
    }

    private function createCategory(string $slug): ForumCategory
    {
        return ForumCategory::create([
            'name' => str($slug)->title()->toString(),
            'slug' => $slug,
        ]);
    }

    private function createForumPost(ForumCategory $category): ForumPost
    {
        $author = User::factory()->create();

        return ForumPost::create([
            'user_id' => $author->id,
            'forum_category_id' => $category->id,
            'title' => 'Zone Two Work',
            'slug' => 'zone-two-work',
            'body' => 'How much zone two do you use?',
        ]);
    }

    private function createComment(): Comment
    {
        $post = $this->createBlogPost();
        $author = User::factory()->create();

        return $post->comments()->create([
            'user_id' => $author->id,
            'body' => 'Original comment.',
        ]);
    }
}
