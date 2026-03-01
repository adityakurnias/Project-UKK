<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row gap-8">

        <!-- Sidebar Filters -->
        <div class="w-full md:w-64 shrink-0">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Filters</h2>

            <div class="space-y-4">
                <div>
                    <flux:label>Search</flux:label>
                    <flux:input wire:model.live.debounce.300ms="search" placeholder="Search products..." />
                </div>

                <div>
                    <flux:label>Category</flux:label>
                    <flux:select wire:model.live="categoryId">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </flux:select>
                </div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="flex-1">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Our Products</h2>

            @if($products->isEmpty())
                <div class="text-center py-10">
                    <flux:icon name="inbox" class="mx-auto h-12 w-12 text-zinc-400" />
                    <h3 class="mt-2 text-sm font-semibold text-zinc-900 dark:text-white">No products found</h3>
                    <p class="mt-1 text-sm text-zinc-500">Try adjusting your search or filters.</p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:gap-x-8">
                    @foreach($products as $product)
                        <div
                            class="group relative bg-white dark:bg-zinc-800 rounded-lg shadow p-4 border border-zinc-200 dark:border-zinc-700">
                            <div
                                class="w-full min-h-48 bg-gray-200 dark:bg-zinc-900 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-48 lg:aspect-none flex items-center justify-center">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-contain">
                            </div>
                            <div class="mt-4 flex justify-between">
                                <div>
                                    <h3 class="text-sm text-gray-700 dark:text-zinc-300">
                                        <a href="{{ route('products.show', $product->slug) }}" wire:navigate>
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
                                <flux:button class="w-full" variant="primary" wire:click="addToCart({{ $product->id }})">Add to
                                    Cart</flux:button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
