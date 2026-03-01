<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="mb-10 text-center md:text-left">
        <h1
            class="text-3xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-linear-to-r from-indigo-600 to-violet-500 tracking-tight mb-4">
            Our Products</h1>
        <p class="text-zinc-500 dark:text-zinc-400 max-w-2xl text-lg">Browse our extensive collection of premium PC
            components and accessories.</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-10">

        <!-- Sidebar Filters -->
        <div class="w-full lg:w-72 shrink-0">
            <div
                class="bg-white dark:bg-zinc-900 rounded-3xl shadow-sm border border-zinc-100 dark:border-zinc-800 p-6 sticky top-24">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                    <flux:icon name="funnel" class="w-5 h-5 text-indigo-500" /> Filters
                </h2>

                <div class="space-y-6">
                    <div>
                        <flux:label>Search</flux:label>
                        <flux:input wire:model.live.debounce.300ms="search" placeholder="Search products..."
                            icon="magnifying-glass" class="mt-2" />
                    </div>

                    <div>
                        <flux:label>Category</flux:label>
                        <div class="mt-2 space-y-2">
                            <label
                                class="flex items-center gap-3 p-2 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-800 cursor-pointer transition-colors">
                                <input type="radio" wire:model.live="categoryId" value=""
                                    class="text-indigo-600 focus:ring-indigo-500 rounded-full border-zinc-300">
                                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">All Categories</span>
                            </label>
                            @foreach($categories as $category)
                                <label
                                    class="flex items-center gap-3 p-2 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-800 cursor-pointer transition-colors">
                                    <input type="radio" wire:model.live="categoryId" value="{{ $category->id }}"
                                        class="text-indigo-600 focus:ring-indigo-500 rounded-full border-zinc-300">
                                    <span
                                        class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="flex-1">
            @if($products->isEmpty())
                <div
                    class="text-center py-20 bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-100 dark:border-zinc-800 border-dashed">
                    <div
                        class="w-20 h-20 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-500 mx-auto rounded-full flex items-center justify-center mb-4">
                        <flux:icon name="inbox" class="h-10 w-10" />
                    </div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">No products found</h3>
                    <p class="mt-2 text-zinc-500">Try adjusting your search or filters to find what you're looking for.</p>
                    <button wire:click="$set('search', ''); $set('categoryId', '');"
                        class="mt-6 px-6 py-2 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 dark:bg-zinc-800 dark:text-indigo-400 dark:hover:bg-zinc-700 rounded-full font-medium transition-colors">
                        Clear all filters
                    </button>
                </div>
            @else
                <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:gap-x-8">
                    @foreach($products as $product)
                        <div
                            class="group relative bg-white dark:bg-zinc-800 rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-zinc-100 dark:border-zinc-700 overflow-hidden flex flex-col">

                            <!-- Image Container -->
                            <div class="relative w-full h-56 bg-zinc-50 dark:bg-zinc-900 overflow-hidden">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300">
                                </div>
                            </div>

                            <!-- Content Container -->
                            <div class="flex-1 p-5 flex flex-col">
                                <p class="text-xs font-bold tracking-widest text-indigo-500 uppercase mb-2">
                                    {{ $product->category->name }}</p>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                    <a href="{{ route('products.show', $product->slug) }}" wire:navigate>
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <div class="mt-auto">
                                    <p class="text-xl font-extrabold text-gray-900 dark:text-white mb-4">Rp
                                        {{ number_format($product->price, 0) }}</p>
                                    <div class="relative z-10 w-full">
                                        @auth
                                            <button
                                                class="w-full py-3 px-4 bg-zinc-900 hover:bg-indigo-600 text-white dark:bg-zinc-700 dark:hover:bg-indigo-500 rounded-xl font-bold transition-colors duration-300 flex items-center justify-center gap-2"
                                                wire:click="addToCart({{ $product->id }})" wire:loading.attr="disabled">
                                                <span wire:loading.remove wire:target="addToCart({{ $product->id }})"
                                                    class="flex items-center justify-center gap-2">
                                                    <flux:icon name="shopping-cart" class="w-5 h-5" /> Add to Cart
                                                </span>
                                                <span wire:loading wire:target="addToCart({{ $product->id }})"
                                                    class="flex items-center justify-center gap-2">
                                                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                            stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                    Adding...
                                                </span>
                                            </button>
                                        @else
                                            <a href="{{ route('login') }}" class="w-full py-3 px-4 bg-zinc-900 hover:bg-indigo-600 text-white dark:bg-zinc-700 dark:hover:bg-indigo-500 rounded-xl font-bold transition-colors duration-300 flex items-center justify-center gap-2" wire:navigate>
                                                <flux:icon name="arrow-right-end-on-rectangle" class="w-5 h-5" /> Login to Buy
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div
                    class="mt-12 bg-white dark:bg-zinc-900 p-4 rounded-2xl shadow-sm border border-zinc-100 dark:border-zinc-800">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
