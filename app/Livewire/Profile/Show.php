<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $posts = $this->user->forumPosts()
            ->with('forumCategory')
            ->latest()
            ->take(10)
            ->get();

        return view('livewire.profile.show', compact('posts'));
    }
}
