<?php

namespace App\Livewire\Store\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.store')]
class Show extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $this->order = $order->load(['items.product']);
    }

    public function render()
    {
        return view('livewire.store.order.show');
    }
}
