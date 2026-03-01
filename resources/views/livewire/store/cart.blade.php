<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-8">Shopping Cart</h1>

    @if(count($cart) > 0)
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <div class="lg:col-span-8">
                <ul role="list"
                    class="border-t border-b border-gray-200 dark:border-zinc-700 divide-y divide-gray-200 dark:divide-zinc-700">
                    @foreach($cart as $id => $item)
                        <li class="flex py-6">
                            <div
                                class="shrink-0 w-24 h-24 bg-gray-200 dark:bg-zinc-800 rounded-md overflow-hidden flex items-center justify-center">
                                @if($item['image_path'])
                                    <img src="{{ asset('storage/' . $item['image_path']) }}" alt="{{ $item['name'] }}"
                                        class="w-full h-full object-center object-cover">
                                @else
                                    <flux:icon name="photo" class="h-8 w-8 text-zinc-400" />
                                @endif
                            </div>

                            <div class="ml-4 flex-1 flex flex-col justify-between">
                                <div class="relative flex-1 flex justify-between">
                                    <div>
                                        <h3 class="text-base font-medium text-gray-900 dark:text-white">
                                            <a href="{{ route('products.show', $id) }}" wire:navigate>{{ $item['name'] }}</a>
                                        </h3>
                                        <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">Rp
                                            {{ number_format($item['price'], 0) }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center border border-gray-300 dark:border-zinc-600 rounded-md">
                                        <button wire:click="updateQuantity({{ $id }}, 'decrease')"
                                            class="px-3 py-1 text-gray-600 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white">-</button>
                                        <span class="px-3 py-1 text-gray-900 dark:text-white">{{ $item['quantity'] }}</span>
                                        <button wire:click="updateQuantity({{ $id }}, 'increase')"
                                            class="px-3 py-1 text-gray-600 dark:text-zinc-400 hover:text-gray-900 dark:hover:text-white">+</button>
                                    </div>
                                    <button wire:click="removeItem({{ $id }})" type="button"
                                        class="text-sm font-medium text-red-600 hover:text-red-500">
                                        <span>Remove</span>
                                    </button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-4 flex justify-between">
                    <flux:button variant="ghost" class="text-red-600 hover:text-red-500" wire:click="clearCart" size="sm">
                        Clear Cart</flux:button>
                    <a href="{{ route('catalog') }}" class="text-indigo-600 hover:text-indigo-500 text-sm font-medium"
                        wire:navigate>Continue Shopping &rarr;</a>
                </div>
            </div>

            <div
                class="mt-8 lg:mt-0 lg:col-span-4 lg:sticky lg:top-8 bg-gray-50 dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg p-6 px-4 py-6 sm:p-6 lg:p-8">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Order summary</h2>

                <dl class="mt-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <dt class="text-sm text-gray-600 dark:text-zinc-400">Subtotal</dt>
                        <dd class="text-sm font-medium text-gray-900 dark:text-white">Rp
                            {{ number_format($this->subtotal, 0) }}</dd>
                    </div>
                </dl>

                <div class="mt-6">
                    <flux:button href="{{ route('checkout') }}" variant="primary" class="w-full" wire:navigate>Checkout
                    </flux:button>
                </div>
            </div>
        </div>
    @else
        <div
            class="text-center py-16 bg-white dark:bg-zinc-800 rounded-lg shadow border border-zinc-200 dark:border-zinc-700">
            <flux:icon name="shopping-cart" class="mx-auto h-12 w-12 text-zinc-400" />
            <h3 class="mt-2 text-lg font-medium text-zinc-900 dark:text-white">Your cart is empty</h3>
            <p class="mt-1 text-sm text-zinc-500">Looks like you haven't added anything to your cart yet.</p>
            <div class="mt-6">
                <flux:button href="{{ route('catalog') }}" variant="primary" wire:navigate>Start Shopping</flux:button>
            </div>
        </div>
    @endif
</div>
