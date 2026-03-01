<?php

namespace App\Livewire\Store;

use Livewire\Component;
use Livewire\Attributes\On;

class CartCount extends Component
{
    #[On('cart-updated')]
    public function render()
    {
        $cart = session()->get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));

        return view('livewire.store.cart-count', compact('count'));
    }
}
