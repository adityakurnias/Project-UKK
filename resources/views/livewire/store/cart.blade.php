<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white flex items-center gap-3">
            <flux:icon name="shopping-bag" class="w-8 h-8 text-indigo-500" /> Shopping Cart
        </h1>
    </div>

    @if(count($cart) > 0)
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <div class="lg:col-span-8">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-3xl shadow-sm border border-zinc-100 dark:border-zinc-800 overflow-hidden">
                    <ul role="list" class="divide-y divide-gray-100 dark:divide-zinc-800">
                        @foreach($cart as $id => $item)
                            <li class="flex py-6 px-6 sm:px-8 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                <div
                                    class="shrink-0 w-24 h-24 bg-zinc-100 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-700 rounded-2xl overflow-hidden flex items-center justify-center">
                                    @if($item['image_path'])
                                        <img src="{{ asset('storage/' . $item['image_path']) }}" alt="{{ $item['name'] }}"
                                            class="w-full h-full object-center object-contain p-2">
                                    @else
                                        <flux:icon name="photo" class="h-8 w-8 text-zinc-300 dark:text-zinc-600" />
                                    @endif
                                </div>

                                <div class="ml-6 flex-1 flex flex-col justify-between">
                                    <div class="relative flex-1 flex flex-col sm:flex-row sm:justify-between gap-4">
                                        <div>
                                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                                <a href="{{ route('products.show', $id) }}"
                                                    class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors"
                                                    wire:navigate>{{ $item['name'] }}</a>
                                            </h3>
                                        </div>
                                        <div>
                                            <p class="text-lg font-extrabold text-indigo-600 dark:text-indigo-400">Rp
                                                {{ number_format($item['price'], 0) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                        <div
                                            class="flex items-center border border-gray-200 dark:border-zinc-700 rounded-xl bg-white dark:bg-zinc-900 overflow-hidden shadow-sm w-fit">
                                            <button wire:click="updateQuantity({{ $id }}, 'decrease')"
                                                class="px-4 py-2 text-gray-500 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-zinc-800 transition-colors">-</button>
                                            <span
                                                class="px-4 py-2 font-bold text-gray-900 dark:text-white border-x border-gray-100 dark:border-zinc-800">{{ $item['quantity'] }}</span>
                                            <button wire:click="updateQuantity({{ $id }}, 'increase')"
                                                class="px-4 py-2 text-gray-500 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-zinc-800 transition-colors">+</button>
                                        </div>
                                        <button wire:click="removeItem({{ $id }})" type="button"
                                            class="text-sm font-semibold text-red-500 hover:text-red-600 flex items-center gap-1 transition-colors">
                                            <flux:icon name="trash" class="w-4 h-4" /> Remove
                                        </button>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div
                        class="bg-gray-50 dark:bg-zinc-950 px-6 sm:px-8 py-4 border-t border-gray-100 dark:border-zinc-800 flex justify-between items-center">
                        <button
                            class="text-red-500 hover:text-red-600 font-medium text-sm flex items-center gap-2 transition-colors"
                            wire:click="clearCart">
                            <flux:icon name="x-mark" class="w-4 h-4" /> Clear Cart
                        </button>
                    </div>
                </div>
            </div>

            <div
                class="mt-8 lg:mt-0 lg:col-span-4 lg:sticky lg:top-8 bg-white dark:bg-zinc-900 border border-gray-100 dark:border-zinc-800 rounded-3xl p-6 sm:p-8 shadow-sm">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Order Summary</h2>

                <dl class="space-y-4 text-sm text-gray-600 dark:text-zinc-400">
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-zinc-800">
                        <dt>Subtotal</dt>
                        <dd class="font-medium text-gray-900 dark:text-white">Rp {{ number_format($this->subtotal, 0) }}
                        </dd>
                    </div>
                    <div class="flex items-center justify-between pb-4 border-b border-gray-100 dark:border-zinc-800">
                        <dt>Shipping</dt>
                        <dd class="font-medium text-gray-900 dark:text-white">Calculated at checkout</dd>
                    </div>
                    <div class="flex items-center justify-between pt-2">
                        <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                        <dd class="text-xl font-extrabold text-indigo-600 dark:text-indigo-400">Rp
                            {{ number_format($this->subtotal, 0) }}</dd>
                    </div>
                </dl>

                <div class="mt-8">
                    <a href="{{ route('checkout') }}" wire:navigate
                        class="w-full h-14 bg-zinc-900 hover:bg-indigo-600 text-white dark:bg-indigo-600 dark:hover:bg-indigo-500 rounded-xl font-bold transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-indigo-500/30">
                        Proceed to Checkout <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('catalog') }}"
                        class="text-indigo-600 hover:text-indigo-500 text-sm font-bold transition-colors" wire:navigate>
                        &larr; Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @else
        <div
            class="text-center py-24 bg-white dark:bg-zinc-900 rounded-3xl shadow-sm border border-zinc-100 dark:border-zinc-800 border-dashed max-w-3xl mx-auto">
            <div
                class="w-24 h-24 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-500 mx-auto rounded-full flex items-center justify-center mb-6">
                <flux:icon name="shopping-cart" class="w-12 h-12" />
            </div>
            <h3 class="text-2xl font-bold text-zinc-900 dark:text-white">Your cart is empty</h3>
            <p class="mt-2 text-zinc-500 max-w-md mx-auto">Looks like you haven't added anything to your cart yet. Browse
                our products and build your dream PC.</p>
            <div class="mt-8">
                <a href="{{ route('catalog') }}" wire:navigate
                    class="inline-flex items-center justify-center h-12 px-8 bg-zinc-900 hover:bg-indigo-600 text-white dark:bg-indigo-600 dark:hover:bg-indigo-500 rounded-full font-bold transition-all duration-300 shadow-md">
                    Start Shopping
                </a>
            </div>
        </div>
    @endif
</div>
