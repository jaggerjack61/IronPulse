<?php

namespace App\Livewire\Components;

use Livewire\Component;

class NotificationDropdown extends Component
{
    public function markAllRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        $notifications = auth()->check()
            ? auth()->user()->notifications()->latest()->take(10)->get()
            : collect();

        return view('livewire.components.notification-dropdown', compact('notifications'));
    }
}
