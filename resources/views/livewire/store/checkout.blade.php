<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">

        <div class="lg:col-span-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-8">Checkout</h1>

            @if (session()->has('error'))
                <div class="rounded-md bg-red-50 dark:bg-red-900/30 p-4 mb-6">
                    <div class="flex">
                        <div class="shrink-0">
                            <flux:icon name="exclamation-circle" class="h-5 w-5 text-red-400" />
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800 dark:text-red-200">There was an issue with your
                                order</h3>
                            <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                                <p>{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form wire:submit="placeOrder" class="space-y-8">
                <div>
                    <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">Shipping Information</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 gap-4">
                            <flux:textarea wire:model="shipping_address" label="Full Address"
                                placeholder="Enter your full shipping address..." rows="4"></flux:textarea>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-medium text-gray-900 dark:text-white mb-4">Payment Method</h2>
                    <flux:radio.group wire:model="payment_method">
                        <flux:radio value="bank_transfer" label="Bank Transfer" />
                        <flux:radio value="cod" label="Cash on Delivery (COD)" />
                        <flux:radio value="credit_card" label="Credit Card" disabled description="Coming soon" />
                    </flux:radio.group>
                </div>

                <div class="pt-6 border-t border-gray-200 dark:border-zinc-700">
                    <flux:button type="submit" variant="primary" class="w-full text-lg py-6">
                        Place Order (Rp {{ number_format($this->subtotal, 0) }})
                    </flux:button>
                </div>
            </form>
        </div>

        <!-- Order Summary -->
        <div
            class="mt-8 lg:mt-0 lg:col-span-4 lg:sticky lg:top-8 bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-6">Order summary</h2>

            <ul role="list"
                class="flex flex-col gap-y-4 divide-y divide-gray-200 dark:divide-zinc-700 border-b border-gray-200 dark:border-zinc-700 pb-6 mb-6">
                @foreach($cart as $item)
                    <li class="flex items-center gap-x-4 py-2">
                        <div
                            class="shrink-0 w-16 h-16 bg-gray-200 dark:bg-zinc-900 rounded-md overflow-hidden flex items-center justify-center">
                            @if($item['image_path'])
                                <img src="{{ asset('storage/' . $item['image_path']) }}" alt="{{ $item['name'] }}"
                                    class="w-full h-full object-center object-cover">
                            @else
                                <flux:icon name="photo" class="h-6 w-6 text-zinc-400" />
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm text-gray-900 dark:text-white font-medium">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-500 dark:text-zinc-400">Qty: {{ $item['quantity'] }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Rp
                            {{ number_format($item['price'] * $item['quantity'], 0) }}</p>
                    </li>
                @endforeach
            </ul>

            <dl class="space-y-4">
                <div class="flex items-center justify-between">
                    <dt class="text-sm text-gray-600 dark:text-zinc-400">Subtotal</dt>
                    <dd class="text-sm font-medium text-gray-900 dark:text-white">Rp
                        {{ number_format($this->subtotal, 0) }}</dd>
                </div>
                <!-- Shipping could be added here -->
                <div class="flex items-center justify-between border-t border-gray-200 dark:border-zinc-700 pt-4">
                    <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                    <dd class="text-base font-bold text-indigo-600 dark:text-indigo-400">Rp
                        {{ number_format($this->subtotal, 0) }}</dd>
                </div>
            </dl>
        </div>

    </div>
</div>
