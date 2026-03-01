<?php

namespace App\Livewire\Store;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.store')]
class Checkout extends Component
{
    public $cart = [];
    public $shipping_address = '';
    public $payment_method = 'bank_transfer';

    protected $rules = [
        'shipping_address' => 'required|string|max:1000',
        'payment_method' => 'required|string|in:bank_transfer,cod,credit_card',
    ];

    public function mount()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $this->cart = session()->get('cart', []);

        if (empty($this->cart)) {
            return redirect()->route('cart');
        }
    }

    public function getSubtotalProperty()
    {
        $total = 0;
        foreach ($this->cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function placeOrder()
    {
        $this->validate();

        if (empty($this->cart)) {
            return redirect()->route('cart');
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $this->subtotal,
                'status' => 'pending',
                'shipping_address' => $this->shipping_address,
                'payment_method' => $this->payment_method,
            ]);

            foreach ($this->cart as $productId => $item) {
                // Verify stock
                $product = Product::lockForUpdate()->find($productId);

                if (!$product || $product->stock < $item['quantity']) {
                    throw new \Exception("Product {$item['name']} is out of stock.");
                }

                $product->decrement('stock', $item['quantity']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                ]);
            }

            session()->forget('cart');
            $this->dispatch('cart-updated');

            DB::commit();

            return redirect()->route('home')->with('success', 'Order placed successfully! Order ID: #' . $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.store.checkout');
    }
}
