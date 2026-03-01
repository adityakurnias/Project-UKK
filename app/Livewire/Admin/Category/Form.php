<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class Form extends Component
{
    public ?Category $category = null;

    public $name = '';
    public $description = '';
    public $is_active = true;

    public function mount(?Category $category = null)
    {
        if ($category && $category->exists) {
            $this->category = $category;
            $this->name = $category->name;
            $this->description = $category->description;
            $this->is_active = $category->is_active;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if (!$this->category) {
            $validated['slug'] = Str::slug($this->name);
            Category::create($validated);
        } else {
            $this->category->update($validated);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category saved successfully.');
    }

    public function render()
    {
        return view('livewire.admin.category.form');
    }
}
