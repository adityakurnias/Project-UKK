<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 xl:gap-x-16">
        <!-- Product Image -->
        <div
            class="w-full h-96 bg-gray-200 dark:bg-zinc-900 rounded-lg overflow-hidden flex items-center justify-center mb-8 lg:mb-0">
            @if($product->image_path)
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                    class="w-full h-full object-center object-cover">
            @else
                <flux:icon name="photo" class="h-24 w-24 text-zinc-400" />
            @endif
        </div>

        <div class="flex flex-col">
            <nav aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-2">
                    <li>
                        <div class="flex items-center text-sm">
                            <a href="{{ route('home') }}"
                                class="font-medium text-gray-500 hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white"
                                wire:navigate>Home</a>
                            <svg class="ml-2 shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                            </svg>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center text-sm">
                            <a href="{{ route('catalog') }}?categoryId={{ $product->category_id }}"
                                class="font-medium text-gray-500 hover:text-gray-900 dark:text-zinc-400 dark:hover:text-white"
                                wire:navigate>{{ $product->category->name }}</a>
                        </div>
                    </li>
                </ol>
            </nav>

            <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                {{ $product->name }}
            </h1>

            <div class="mt-4">
                <h2 class="sr-only">Product information</h2>
                <p class="text-3xl text-indigo-600 dark:text-indigo-400 font-bold">Rp
                    {{ number_format($product->price, 0) }}
                </p>
            </div>

            <div class="mt-6 flex flex-col gap-4">
                <h3 class="sr-only">Description</h3>
                <div class="text-base text-gray-700 dark:text-zinc-300 space-y-6">
                    {{ $product->description ?: 'No description provided.' }}
                </div>

                <div class="mt-2 text-sm">
                    <span class="font-medium text-gray-900 dark:text-white">Stock:</span>
                    <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }} ml-2">
                        {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
                    </span>
                </div>
            </div>

            <div class="mt-8 flex gap-4 border-t border-gray-200 dark:border-zinc-700 pt-8">
                <div class="w-24">
                    <flux:input type="number" wire:model="quantity" min="1" max="{{ $product->stock }}"
                        class="w-full text-center" />
                </div>
                <flux:button variant="primary" wire:click="addToCart" class="flex-1" :disabled="$product->stock < 1">
                    Add to Cart
                </flux:button>
            </div>
        </div>
    </div>
</div>
