<?php

namespace App\Livewire\Admin;

use App\Models\ForumCategory;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ForumCategoryManage extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string')]
    public ?string $description = null;

    public function create()
    {
        $this->validate();

        ForumCategory::create([
            'name' => $this->name,
            'slug' => \Illuminate\Support\Str::slug($this->name) . '-' . uniqid(),
            'description' => $this->description,
            'sort_order' => ForumCategory::max('sort_order') + 1,
        ]);

        $this->reset();
    }

    public function delete(int $id)
    {
        ForumCategory::find($id)?->delete();
    }

    public function render()
    {
        $categories = ForumCategory::orderBy('sort_order')->get();

        return view('livewire.admin.forum-category-manage', compact('categories'));
    }
}
