<?php

namespace App\Livewire\Store;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.store')]
class Cart extends Component
{
    public $cart = [];

    public function mount()
    {
        $this->cart = session()->get('cart', []);
    }

    public function updateQuantity($productId, $action)
    {
        if (isset($this->cart[$productId])) {
            if ($action === 'increase') {
                $this->cart[$productId]['quantity']++;
            } elseif ($action === 'decrease' && $this->cart[$productId]['quantity'] > 1) {
                $this->cart[$productId]['quantity']--;
            }
            session()->put('cart', $this->cart);
            $this->dispatch('cart-updated');
        }
    }

    public function removeItem($productId)
    {
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
            session()->put('cart', $this->cart);
            $this->dispatch('cart-updated');
        }
    }

    public function clearCart()
    {
        $this->cart = [];
        session()->forget('cart');
        $this->dispatch('cart-updated');
    }

    public function getSubtotalProperty()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function render()
    {
        return view('livewire.store.cart');
    }
}
