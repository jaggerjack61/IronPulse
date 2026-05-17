<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
    public User $user;
    public bool $isFollowing = false;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->isFollowing = auth()->check()
            ? auth()->user()->following()->where('following_id', $user->id)->exists()
            : false;
    }

    public function toggleFollow()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        if ($this->isFollowing) {
            auth()->user()->following()->where('following_id', $this->user->id)->delete();
            $this->isFollowing = false;
        } else {
            auth()->user()->following()->create([
                'following_id' => $this->user->id,
            ]);
            $this->isFollowing = true;
        }
    }

    public function render()
    {
        return view('livewire.components.follow-button');
    }
}
