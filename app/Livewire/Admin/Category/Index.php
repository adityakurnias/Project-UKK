<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public function delete(Category $category)
    {
        $category->delete();
        session()->flash('success', 'Category deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.category.index', [
            'categories' => Category::latest()->get(),
        ]);
    }
}
