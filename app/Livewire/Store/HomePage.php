<?php

namespace App\Livewire\Store;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.store')]
class HomePage extends Component
{
    public function render()
    {
        return view('livewire.store.home-page', [
            'featuredProducts' => Product::with('category')->where('is_active', true)->latest()->take(8)->get(),
            'categories' => Category::where('is_active', true)->get(),
        ]);
    }

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
}
