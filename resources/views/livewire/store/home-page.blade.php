<div>
    <!-- Hero Section with Gradient -->
    <div
        class="relative bg-gradient-to-br from-indigo-900 via-indigo-800 to-violet-900 rounded-3xl overflow-hidden shadow-2xl mx-4 sm:mx-6 lg:mx-8 mb-16 mt-6">
        <div
            class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10">
        </div>
        <div class="relative px-6 py-24 sm:py-32 lg:px-12 lg:py-40 flex flex-col items-center text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-7xl mb-6 drop-shadow-lg">
                <span class="block">Welcome to <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-300">Giga.id</span></span>
            </h1>
            <p class="mt-4 max-w-2xl text-lg sm:text-xl text-indigo-100 font-medium">
                Your premium destination for high-performance computer parts and accessories. Build your dream rig
                today.
            </p>
            <div class="mt-10 flex gap-4">
                <a href="{{ route('catalog') }}"
                    class="px-8 py-4 bg-white text-indigo-900 text-lg font-bold rounded-full shadow-lg hover:shadow-xl hover:bg-gray-50 hover:scale-105 transition-all duration-300"
                    wire:navigate>
                    Shop Now
                </a>
            </div>
        </div>
    </div>

    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Categories -->
        <div class="mb-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Shop by Category</h2>
                <div class="h-1 flex-1 bg-gradient-to-r from-indigo-500 to-transparent ml-6 rounded-full opacity-20">
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('catalog') }}?categoryId={{ $category->id }}"
                        class="group relative overflow-hidden rounded-2xl shadow-md bg-white dark:bg-zinc-800 hover:shadow-xl transition-all duration-300 flex flex-col items-center justify-center p-8 border border-gray-100 dark:border-zinc-700 hover:border-indigo-400 dark:hover:border-indigo-500 translate-y-0 hover:-translate-y-2"
                        wire:navigate>
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-white dark:from-zinc-800 dark:to-zinc-900 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <span
                            class="relative text-xl font-bold text-gray-800 dark:text-zinc-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Featured Products -->
        <div class="mb-20">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Featured Products</h2>
                <a href="{{ route('catalog') }}"
                    class="text-sm font-semibold text-indigo-600 hover:text-indigo-500 flex items-center gap-1 group"
                    wire:navigate>
                    View all <span class="group-hover:translate-x-1 transition-transform"
                        aria-hidden="true">&rarr;</span>
                </a>
            </div>

            <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                @foreach($featuredProducts as $product)
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
                                        <a href="{{ route('login') }}"
                                            class="w-full py-3 px-4 bg-zinc-900 hover:bg-indigo-600 text-white dark:bg-zinc-700 dark:hover:bg-indigo-500 rounded-xl font-bold transition-colors duration-300 flex items-center justify-center gap-2"
                                            wire:navigate>
                                            <flux:icon name="arrow-right-end-on-rectangle" class="w-5 h-5" /> Login to Buy
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
