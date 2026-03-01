<?php

namespace App\Livewire\Store;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.store')]
class ProductShow extends Component
{
    public Product $product;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->firstOrFail();
    }

    public function addToCart()
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$this->product->id])) {
            $cart[$this->product->id]['quantity'] += $this->quantity;
        } else {
            $cart[$this->product->id] = [
                'name' => $this->product->name,
                'price' => $this->product->price,
                'quantity' => $this->quantity,
                'image_path' => $this->product->image_path,
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.store.product-show');
    }
}
