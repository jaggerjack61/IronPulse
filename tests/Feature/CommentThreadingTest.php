<?php

namespace Tests\Feature;

use App\Livewire\Components\CommentSection;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CommentThreadingTest extends TestCase
{
    use RefreshDatabase;

    public function test_replies_use_parent_id_and_keep_the_original_commentable(): void
    {
        $author = User::factory()->create();
        $replier = User::factory()->create();
        $post = BlogPost::create([
            'user_id' => $author->id,
            'title' => 'Recovery Basics',
            'slug' => 'recovery-basics',
            'body' => 'Sleep matters.',
            'published_at' => now()->subDay(),
        ]);
        $comment = $post->comments()->create([
            'user_id' => $author->id,
            'body' => 'Original comment.',
        ]);

        Livewire::actingAs($replier)
            ->test(CommentSection::class, ['comment' => $comment])
            ->set('replyBody', 'I agree.')
            ->call('addReply')
            ->assertDispatched('reply-added');

        $reply = Comment::where('body', 'I agree.')->firstOrFail();

        $this->assertSame($comment->id, $reply->parent_id);
        $this->assertSame($post->id, $reply->commentable_id);
        $this->assertSame(BlogPost::class, $reply->commentable_type);
    }
}
