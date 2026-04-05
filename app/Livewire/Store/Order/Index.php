<?php

namespace App\Livewire\Store\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.store')]
class Index extends Component
{
    public function render()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['items'])
            ->latest()
            ->get();

        return view('livewire.store.order.index', compact('orders'));
    }
}
