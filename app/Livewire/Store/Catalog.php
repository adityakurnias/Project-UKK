<?php

namespace App\Livewire\Store;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.store')]
class Catalog extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryId = null;

    public function addToCart($productId)
    {
        $product = Product::find($productId);
        if (!$product)
            return;

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image_path' => $product->image_path,
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::with('category')->where('is_active', true);

        if ($this->search) {
            $products->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->categoryId) {
            $products->where('category_id', $this->categoryId);
        }

        return view('livewire.store.catalog', [
            'products' => $products->latest()->paginate(12),
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }
}
