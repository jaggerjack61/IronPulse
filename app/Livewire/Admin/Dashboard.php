<?php

namespace App\Livewire\Admin;

use App\Models\BlogPost;
use App\Models\ForumCategory;
use App\Models\ForumPost;
use App\Models\MailboxMessage;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'users' => User::count(),
            'posts' => ForumPost::count(),
            'blog_posts' => BlogPost::count(),
            'categories' => ForumCategory::count(),
            'mailbox_messages' => MailboxMessage::count(),
        ];

        $latestUsers = User::latest()->take(5)->get();
        $latestPosts = ForumPost::with('user')->latest()->take(5)->get();

        return view('livewire.admin.dashboard', compact('stats', 'latestUsers', 'latestPosts'));
    }
}
