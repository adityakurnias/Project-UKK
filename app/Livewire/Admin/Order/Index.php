<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.order.index', [
            'orders' => Order::with('user')->latest()->get(),
        ]);
    }
}
