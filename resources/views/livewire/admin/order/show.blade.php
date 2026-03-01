<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">Order #{{ $order->id }} Details</flux:heading>
        <flux:button variant="ghost" href="{{ route('admin.orders.index') }}" wire:navigate>Back to Orders</flux:button>
    </div>

    @if (session()->has('success'))
        <div class="rounded-md bg-green-50 dark:bg-green-900/30 p-4">
            <div class="flex">
                <div class="shrink-0">
                    <flux:icon name="check-circle" class="h-5 w-5 text-green-400" />
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Info -->
        <div class="lg:col-span-2 space-y-6">
            <flux:card>
                <flux:heading size="lg" class="mb-4">Items</flux:heading>
                <ul role="list" class="divide-y divide-gray-200 dark:divide-zinc-700">
                    @foreach($order->items as $item)
                        <li class="py-4 flex">
                            <div
                                class="shrink-0 w-16 h-16 bg-gray-200 dark:bg-zinc-800 rounded-md overflow-hidden flex items-center justify-center">
                                @if($item->product && $item->product->image_path)
                                    <img src="{{ asset('storage/' . $item->product->image_path) }}"
                                        class="w-full h-full object-center object-cover">
                                @else
                                    <flux:icon name="photo" class="h-6 w-6 text-zinc-400" />
                                @endif
                            </div>
                            <div class="ml-4 flex-1 flex flex-col justify-center">
                                <div class="flex justify-between text-base font-medium text-gray-900 dark:text-white">
                                    <h3>{{ $item->product ? $item->product->name : 'Unknown Product' }}</h3>
                                    <p class="ml-4">Rp {{ number_format($item->unit_price * $item->quantity, 0) }}</p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500 dark:text-zinc-400">Qty {{ $item->quantity }} x Rp
                                    {{ number_format($item->unit_price, 0) }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div
                    class="pt-4 mt-4 border-t border-gray-200 dark:border-zinc-700 flex justify-between font-bold text-lg dark:text-white">
                    <span>Total</span>
                    <span>Rp {{ number_format($order->total_amount, 0) }}</span>
                </div>
            </flux:card>
        </div>

        <!-- Customer & Status Info -->
        <div class="space-y-6">
            <flux:card>
                <flux:heading size="lg" class="mb-4">Customer Details</flux:heading>
                <div class="space-y-3 text-sm dark:text-zinc-300">
                    <div>
                        <span class="font-medium text-gray-900 dark:text-white">Name:</span> {{ $order->user->name }}
                    </div>
                    <div>
                        <span class="font-medium text-gray-900 dark:text-white">Email:</span> {{ $order->user->email }}
                    </div>
                </div>
            </flux:card>

            <flux:card>
                <flux:heading size="lg" class="mb-4">Shipping & Payment</flux:heading>
                <div class="space-y-3 text-sm dark:text-zinc-300">
                    <div>
                        <span class="font-medium block text-gray-900 dark:text-white mb-1">Address:</span>
                        <div
                            class="bg-gray-50 dark:bg-zinc-800 p-3 rounded border border-gray-200 dark:border-zinc-700">
                            {{ $order->shipping_address ?: 'No address provided' }}
                        </div>
                    </div>
                    <div class="pt-2">
                        <span class="font-medium text-gray-900 dark:text-white">Method:</span>
                        <span class="uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                    </div>
                </div>
            </flux:card>

            <flux:card>
                <form wire:submit="updateStatus">
                    <flux:heading size="lg" class="mb-4">Order Status</flux:heading>
                    <div class="space-y-4">
                        <flux:select wire:model="status" label="Current Status">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </flux:select>
                        <flux:button type="submit" variant="primary" class="w-full">Update Status</flux:button>
                    </div>
                </form>
            </flux:card>
        </div>
    </div>
</div>
