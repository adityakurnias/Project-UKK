<?php

namespace App\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class Index extends Component
{
    public function delete(Product $product)
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        $product->delete();
        session()->flash('success', 'Product deleted successfully.');
    }

    public function render()
    {
        return view('livewire.admin.product.index', [
            'products' => Product::with('category')->latest()->get(),
        ]);
    }
}
