<div class="px-4 py-8 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white flex items-center gap-3">
            <flux:icon name="clipboard-document-list" class="w-8 h-8 text-indigo-500" />
            Pesanan Saya
        </h1>
        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Riwayat semua pesanan yang pernah kamu buat.</p>
    </div>

    @if($orders->isNotEmpty())
        <div class="space-y-4">
            @foreach($orders as $order)
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
                <a href="{{ route('orders.show', $order) }}" wire:navigate
                   class="group flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white dark:bg-zinc-900 border border-zinc-100 dark:border-zinc-800 rounded-3xl px-6 py-5 shadow-sm hover:-translate-y-0.5 hover:shadow-md hover:border-indigo-200 dark:hover:border-indigo-800 transition-all duration-200">

                    <!-- Left: order info -->
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-center w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 shrink-0">
                            <flux:icon name="shopping-bag" class="w-6 h-6" />
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                Order #{{ $order->id }}
                                <flux:badge color="{{ $badgeColor }}" size="sm">{{ $statusLabel }}</flux:badge>
                            </div>
                            <div class="text-sm text-zinc-500 dark:text-zinc-400 mt-0.5">
                                {{ $order->created_at->translatedFormat('d M Y') }}
                                &middot;
                                {{ $order->items->count() }} item
                            </div>
                        </div>
                    </div>

                    <!-- Right: total + chevron -->
                    <div class="flex items-center gap-4 sm:shrink-0">
                        <span class="text-xl font-extrabold text-indigo-600 dark:text-indigo-400">
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>
                        <flux:icon name="chevron-right" class="w-5 h-5 text-zinc-400 group-hover:text-indigo-500 transition-colors" />
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-24 bg-white dark:bg-zinc-900 rounded-3xl shadow-sm border border-zinc-100 dark:border-zinc-800 border-dashed max-w-3xl mx-auto">
            <div class="w-24 h-24 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-500 mx-auto rounded-full flex items-center justify-center mb-6">
                <flux:icon name="clipboard-document-list" class="w-12 h-12" />
            </div>
            <h3 class="text-2xl font-bold text-zinc-900 dark:text-white">Belum Ada Pesanan</h3>
            <p class="mt-2 text-zinc-500 max-w-md mx-auto">Kamu belum pernah melakukan pemesanan. Yuk mulai belanja!</p>
            <div class="mt-8">
                <a href="{{ route('catalog') }}" wire:navigate
                   class="inline-flex items-center justify-center h-12 px-8 bg-zinc-900 hover:bg-indigo-600 text-white dark:bg-indigo-600 dark:hover:bg-indigo-500 rounded-full font-bold transition-all duration-300 shadow-md">
                    Mulai Belanja
                </a>
            </div>
        </div>
    @endif
</div>
