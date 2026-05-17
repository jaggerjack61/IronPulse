<?php

namespace Tests\Feature;

use App\Events\NewMessage;
use App\Livewire\Message\Compose;
use App\Livewire\Message\ConversationComponent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\TestCase;

class MessageFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_participants_cannot_view_conversations(): void
    {
        $participant = User::factory()->create();
        $otherParticipant = User::factory()->create();
        $intruder = User::factory()->create();
        $conversation = $this->createConversation($participant, $otherParticipant);

        $this->actingAs($intruder)
            ->get(route('messages.show', $conversation->id))
            ->assertForbidden();
    }

    public function test_non_participants_cannot_mount_conversations_directly(): void
    {
        $participant = User::factory()->create();
        $otherParticipant = User::factory()->create();
        $intruder = User::factory()->create();
        $conversation = $this->createConversation($participant, $otherParticipant);

        Livewire::actingAs($intruder)
            ->test(ConversationComponent::class, ['conversationId' => $conversation->id])
            ->assertForbidden();

        $this->assertDatabaseMissing('messages', [
            'conversation_id' => $conversation->id,
            'user_id' => $intruder->id,
        ]);
    }

    public function test_participants_send_messages_with_broadcast_and_conversation_touch(): void
    {
        Event::fake([NewMessage::class]);

        $sender = User::factory()->create();
        $recipient = User::factory()->create();
        $conversation = $this->createConversation($sender, $recipient);
        $staleTimestamp = now()->subHour();

        $conversation->forceFill([
            'created_at' => $staleTimestamp,
            'updated_at' => $staleTimestamp,
        ])->save();

        Livewire::actingAs($sender)
            ->test(ConversationComponent::class, ['conversationId' => $conversation->id])
            ->set('body', 'Training at six?')
            ->call('sendMessage')
            ->assertHasNoErrors();

        $message = Message::where('conversation_id', $conversation->id)
            ->where('user_id', $sender->id)
            ->where('body', 'Training at six?')
            ->firstOrFail();

        Event::assertDispatched(
            NewMessage::class,
            fn (NewMessage $event): bool => $event->message->is($message),
        );

        $this->assertTrue($conversation->refresh()->updated_at->greaterThan($staleTimestamp));
    }

    public function test_compose_route_renders_before_conversation_wildcard_route(): void
    {
        $this->actingAs(User::factory()->create())
            ->get(route('messages.compose'))
            ->assertOk()
            ->assertSee('New Message');
    }

    public function test_users_cannot_send_messages_to_themselves(): void
    {
        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(Compose::class)
            ->set('recipientId', $user->id)
            ->set('body', 'Note to self')
            ->call('send')
            ->assertHasErrors(['recipientId']);

        $this->assertDatabaseCount('conversations', 0);
    }

    private function createConversation(User $firstParticipant, User $secondParticipant): Conversation
    {
        $conversation = Conversation::create();

        $conversation->users()->attach([
            $firstParticipant->id,
            $secondParticipant->id,
        ]);

        return $conversation;
    }
}
