<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div
        class="bg-white dark:bg-zinc-900 rounded-3xl shadow-sm border border-zinc-100 dark:border-zinc-800 p-6 lg:p-12">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            <!-- Product Image -->
            <div
                class="w-full relative h-100 sm:h-125 bg-zinc-50 dark:bg-zinc-950 rounded-2xl overflow-hidden flex items-center justify-center mb-8 lg:mb-0 group border border-zinc-100 dark:border-zinc-800">
                @if($product->image_path)
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
                        class="w-full h-full object-contain p-8 group-hover:scale-110 transition-transform duration-500">
                @else
                    <flux:icon name="photo" class="h-24 w-24 text-zinc-300 dark:text-zinc-600" />
                @endif
                <div
                    class="absolute top-4 left-4 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold text-indigo-600 uppercase tracking-wider">
                    {{ $product->category->name }}
                </div>
            </div>

            <div class="flex flex-col">
                <nav aria-label="Breadcrumb">
                    <ol role="list" class="flex items-center space-x-2">
                        <li>
                            <div class="flex items-center text-sm">
                                <a href="{{ route('home') }}"
                                    class="font-medium text-zinc-500 hover:text-indigo-600 dark:text-zinc-400 dark:hover:text-indigo-400 transition-colors"
                                    wire:navigate>Home</a>
                                <svg class="ml-2 shrink-0 h-5 w-5 text-zinc-300 dark:text-zinc-600"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"
                                    aria-hidden="true">
                                    <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                                </svg>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center text-sm">
                                <a href="{{ route('catalog') }}?categoryId={{ $product->category_id }}"
                                    class="font-medium text-zinc-500 hover:text-indigo-600 dark:text-zinc-400 dark:hover:text-indigo-400 transition-colors"
                                    wire:navigate>{{ $product->category->name }}</a>
                            </div>
                        </li>
                    </ol>
                </nav>

                <h1 class="mt-6 text-3xl font-extrabold tracking-tight text-zinc-900 dark:text-white sm:text-5xl mb-4">
                    {{ $product->name }}
                </h1>

                <div class="mt-2 text-sm flex items-center gap-3">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $product->stock > 0 ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }}">
                        <span
                            class="w-2 h-2 rounded-full mr-2 {{ $product->stock > 0 ? 'bg-green-500' : 'bg-red-500' }}"></span>
                        {{ $product->stock > 0 ? $product->stock . ' IN STOCK' : 'OUT OF STOCK' }}
                    </span>
                </div>

                <div class="mt-8 mb-6 pb-6 border-b border-zinc-100 dark:border-zinc-800">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-4xl text-indigo-600 dark:text-indigo-400 font-extrabold tracking-tight">Rp
                        {{ number_format($product->price, 0) }}
                    </p>
                </div>

                <div class="flex flex-col gap-4 flex-1">
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Description</h3>
                    <div
                        class="text-base text-zinc-600 dark:text-zinc-400 leading-relaxed border border-zinc-100 dark:border-zinc-800 rounded-2xl p-6 bg-zinc-50 dark:bg-zinc-950">
                        {{ $product->description ?: 'No description provided for this product.' }}
                    </div>
                </div>

                <div class="mt-8 flex gap-4 pt-4">
                    <div class="w-32">
                        <flux:input type="number" wire:model="quantity" min="1" max="{{ $product->stock }}"
                            class="w-full text-center h-14" />
                    </div>
                    @auth
                        <button wire:click="addToCart" wire:loading.attr="disabled"
                            class="flex-1 h-14 bg-zinc-900 hover:bg-indigo-600 text-white dark:bg-indigo-600 dark:hover:bg-indigo-500 rounded-xl font-bold transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-indigo-500/30 disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ $product->stock < 1 ? 'disabled' : '' }}>
                            <span wire:loading.remove wire:target="addToCart"
                                class="flex items-center justify-center gap-2">
                                <flux:icon name="shopping-bag" class="w-6 h-6" /> Add to Cart
                            </span>
                            <span wire:loading wire:target="addToCart" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
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
                            class="flex-1 h-14 bg-zinc-900 hover:bg-indigo-600 text-white dark:bg-indigo-600 dark:hover:bg-indigo-500 rounded-xl font-bold transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-indigo-500/30"
                            wire:navigate>
                            <flux:icon name="arrow-right-end-on-rectangle" class="w-6 h-6" /> Login to Buy
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
