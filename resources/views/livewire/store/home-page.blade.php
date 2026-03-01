<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="text-center mb-12">
        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl dark:text-white">
            <span class="block xl:inline">Welcome to</span>
            <span class="block text-indigo-600 xl:inline">Giga.id</span>
        </h1>
        <p
            class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl dark:text-zinc-300">
            Your premium destination for high-performance computer parts and accessories.
        </p>
    </div>

    <!-- Categories -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Shop by Category</h2>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <a href="#"
                    class="rounded-lg shadow flex items-center justify-center p-6 bg-white dark:bg-zinc-800 hover:bg-slate-50 dark:hover:bg-zinc-700 transition">
                    <span class="text-lg font-medium text-gray-900 dark:text-white">{{ $category->name }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Products -->
    <div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Featured Products</h2>
            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all<span
                    aria-hidden="true"> &rarr;</span></a>
        </div>

        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-4 xl:gap-x-8">
            @foreach($featuredProducts as $product)
                <div
                    class="group relative bg-white dark:bg-zinc-800 rounded-lg shadow p-4 border border-zinc-200 dark:border-zinc-700">
                    <div
                        class="w-full min-h-48 bg-gray-200 dark:bg-zinc-900 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-48 lg:aspect-none flex items-center justify-center">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700 dark:text-zinc-300">
                                <a href="{{ route('products.show', $product->slug) }}">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-zinc-400">{{ $product->category->name }}</p>
                        </div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Rp
                            {{ number_format($product->price, 0) }}
                        </p>
                    </div>
                    <div class="mt-4">
                        <flux:button class="w-full" variant="primary" wire:click="addToCart({{ $product->id }})">Add to Cart
                        </flux:button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
