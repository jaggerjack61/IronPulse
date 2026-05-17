<?php

namespace App\Http\Controllers;

use App\Models\Conversation;

class MessageController extends Controller
{
    public function index()
    {
        return view('messages.index');
    }

    public function show(int $conversationId)
    {
        $conversation = Conversation::findOrFail($conversationId);

        abort_unless($conversation->users()->whereKey(auth()->id())->exists(), 403);

        return view('messages.show', compact('conversationId'));
    }
}
