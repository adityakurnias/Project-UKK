<a href="{{ route('cart') }}"
    class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-zinc-300 dark:hover:text-white transition-colors rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-800"
    wire:navigate>
    <flux:icon name="shopping-cart" class="h-5 w-5" />
    <span>Cart ({{ $count }})</span>
</a>
