<?php

namespace App\Livewire\Admin;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BlogPostCreate extends Component
{
    #[Validate('required|string|max:255')]
    public string $title = '';

    #[Validate('required|string')]
    public string $body = '';

    #[Validate('nullable|string|max:500')]
    public ?string $excerpt = null;

    #[Validate('boolean')]
    public bool $publish = false;

    public function save()
    {
        $this->validate();

        BlogPost::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'slug' => Str::slug($this->title) . '-' . uniqid(),
            'body' => $this->body,
            'excerpt' => $this->excerpt,
            'published_at' => $this->publish ? now() : null,
        ]);

        $this->reset();
        session()->flash('message', 'Blog post created successfully.');
    }

    public function render()
    {
        return view('livewire.admin.blog-post-create');
    }
}
