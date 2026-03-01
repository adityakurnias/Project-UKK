<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Show extends Component
{
    public Order $order;
    public $status;

    public function mount(Order $order)
    {
        $this->order = $order->load(['user', 'items.product']);
        $this->status = $order->status;
    }

    public function updateStatus()
    {
        $this->order->update(['status' => $this->status]);
        session()->flash('success', 'Order status updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.order.show');
    }
}
