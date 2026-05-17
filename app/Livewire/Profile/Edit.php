<?php

namespace App\Livewire\Profile;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string')]
    public ?string $bio = null;

    #[Validate('nullable|image|max:1024')]
    public $avatar = null;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->bio = auth()->user()->bio;
    }

    public function update()
    {
        $this->validate();

        $user = auth()->user();
        $user->name = $this->name;
        $user->bio = $this->bio;

        if ($this->avatar) {
            $path = $this->avatar->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        session()->flash('message', 'Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.profile.edit');
    }
}
