<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white flex items-center gap-3">
                <flux:icon name="clipboard-document-list" class="w-8 h-8 text-indigo-500" />
                Order #{{ $order->id }}
            </h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $order->created_at->translatedFormat('d M Y, H:i') }}</p>
        </div>
        <a href="{{ route('orders.index') }}" wire:navigate
           class="inline-flex items-center gap-1.5 text-sm font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 transition-colors">
            <flux:icon name="arrow-left" class="w-4 h-4" />
            Semua Pesanan
        </a>
    </div>

    @php
        $badgeColor = match($order->status) {
            'completed'  => 'green',
            'cancelled'  => 'red',
            'shipped'    => 'blue',
            'processing' => 'sky',
            default      => 'yellow',
        };
        $statusLabel = match($order->status) {
            'pending'    => 'Menunggu',
            'processing' => 'Diproses',
            'shipped'    => 'Dikirim',
            'completed'  => 'Selesai',
            'cancelled'  => 'Dibatalkan',
            default      => ucfirst($order->status),
        };
    @endphp

    <div class="lg:grid lg:grid-cols-12 lg:gap-x-8 lg:items-start">

        <!-- Items List -->
        <div class="lg:col-span-8">
            <div class="bg-white dark:bg-zinc-900 rounded-3xl shadow-sm border border-zinc-100 dark:border-zinc-800 overflow-hidden">
                <div class="px-6 py-4 border-b border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Item Pesanan</h2>
                    <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ $order->items->count() }} item</span>
                </div>
                <ul role="list" class="divide-y divide-gray-100 dark:divide-zinc-800">
                    @foreach($order->items as $item)
                        <li class="flex py-5 px-6 sm:px-8">
                            <!-- Product image -->
                            <div class="shrink-0 w-20 h-20 bg-zinc-100 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-700 rounded-2xl overflow-hidden flex items-center justify-center">
                                @if($item->product && $item->product->image_path)
                                    <img src="{{ asset('storage/' . $item->product->image_path) }}"
                                         alt="{{ $item->product->name }}"
                                         class="w-full h-full object-center object-contain p-2">
                                @else
                                    <flux:icon name="photo" class="h-8 w-8 text-zinc-300 dark:text-zinc-600" />
                                @endif
                            </div>

                            <!-- Info -->
                            <div class="ml-5 flex-1 flex flex-col justify-center">
                                <div class="flex justify-between gap-4">
                                    <div>
                                        <h3 class="text-base font-bold text-gray-900 dark:text-white">
                                            {{ $item->product ? $item->product->name : 'Produk tidak tersedia' }}
                                        </h3>
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">
                                            {{ $item->quantity }} × Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <p class="text-base font-extrabold text-gray-900 dark:text-white shrink-0">
                                        Rp {{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <!-- Total row -->
                <div class="bg-gray-50 dark:bg-zinc-950 px-6 sm:px-8 py-4 border-t border-gray-100 dark:border-zinc-800 flex items-center justify-between">
                    <span class="text-base font-bold text-gray-900 dark:text-white">Total</span>
                    <span class="text-xl font-extrabold text-indigo-600 dark:text-indigo-400">
                        Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Sidebar: Status + Shipping -->
        <div class="mt-8 lg:mt-0 lg:col-span-4 space-y-5">

            <!-- Status card -->
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-3xl p-6 shadow-sm">
                <h2 class="text-base font-bold text-gray-900 dark:text-white mb-4">Status Pesanan</h2>
                <div class="flex items-center gap-3">
                    <flux:badge color="{{ $badgeColor }}" size="lg">{{ $statusLabel }}</flux:badge>
                </div>
            </div>

            <!-- Shipping + Payment card -->
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-3xl p-6 shadow-sm space-y-5">
                <h2 class="text-base font-bold text-gray-900 dark:text-white">Pengiriman & Pembayaran</h2>

                <div>
                    <span class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 dark:text-zinc-500 mb-1">
                        Alamat Pengiriman
                    </span>
                    <div class="bg-gray-50 dark:bg-zinc-800 rounded-xl p-3 text-sm text-gray-700 dark:text-zinc-300 border border-zinc-100 dark:border-zinc-700 leading-relaxed">
                        {{ $order->shipping_address ?: 'Tidak ada alamat.' }}
                    </div>
                </div>

                <div>
                    <span class="block text-xs font-semibold uppercase tracking-wide text-zinc-400 dark:text-zinc-500 mb-1">
                        Metode Pembayaran
                    </span>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ match($order->payment_method) {
                            'bank_transfer' => 'Transfer Bank',
                            'cod'           => 'Cash on Delivery (COD)',
                            'credit_card'   => 'Kartu Kredit',
                            default         => ucwords(str_replace('_', ' ', $order->payment_method)),
                        } }}
                    </span>
                </div>
            </div>

            <!-- Summary card -->
            <div class="bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-3xl p-6 shadow-sm">
                <h2 class="text-base font-bold text-gray-900 dark:text-white mb-4">Ringkasan</h2>
                <dl class="space-y-3 text-sm text-zinc-600 dark:text-zinc-400">
                    <div class="flex justify-between">
                        <dt>Subtotal</dt>
                        <dd class="font-medium text-gray-900 dark:text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</dd>
                    </div>
                    <div class="flex justify-between border-t border-zinc-100 dark:border-zinc-800 pt-3">
                        <dt class="font-bold text-gray-900 dark:text-white">Total</dt>
                        <dd class="font-extrabold text-indigo-600 dark:text-indigo-400 text-base">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</dd>
                    </div>
                </dl>
            </div>

            <a href="{{ route('catalog') }}" wire:navigate
               class="flex items-center justify-center h-12 px-8 w-full bg-zinc-900 hover:bg-indigo-600 text-white dark:bg-indigo-600 dark:hover:bg-indigo-500 rounded-2xl font-bold transition-all duration-300 shadow-md text-sm">
                Lanjut Belanja
            </a>
        </div>
    </div>
</div>
