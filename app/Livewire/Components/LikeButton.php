<?php

namespace App\Livewire\Components;

use Livewire\Component;

class LikeButton extends Component
{
    public $likeable;
    public string $type;

    public function mount($likeable, string $type = 'like')
    {
        $this->likeable = $likeable;
        $this->type = $type;
    }

    public function toggleLike()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }

        $existing = $this->likeable->likes()
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            if ($existing->type === $this->type) {
                $existing->delete();
            } else {
                $existing->update(['type' => $this->type]);
            }
        } else {
            $this->likeable->likes()->create([
                'user_id' => auth()->id(),
                'type' => $this->type,
            ]);
        }

        $this->likeable->refresh();
    }

    public function render()
    {
        $count = $this->likeable->likes()->where('type', $this->type)->count();
        $userLike = auth()->check()
            ? $this->likeable->likes()->where('user_id', auth()->id())->first()
            : null;
        $isActive = $userLike && $userLike->type === $this->type;

        return view('livewire.components.like-button', compact('count', 'isActive'));
    }
}
