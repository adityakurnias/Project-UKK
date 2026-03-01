<div class="space-y-6">
    <flux:heading size="xl">Admin Dashboard</flux:heading>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
        <flux:card>
            <flux:heading>Total Orders</flux:heading>
            <div class="mt-2 text-3xl font-bold">{{ \App\Models\Order::count() }}</div>
        </flux:card>

        <flux:card>
            <flux:heading>Total Products</flux:heading>
            <div class="mt-2 text-3xl font-bold">{{ \App\Models\Product::count() }}</div>
        </flux:card>

        <flux:card>
            <flux:heading>Total Categories</flux:heading>
            <div class="mt-2 text-3xl font-bold">{{ \App\Models\Category::count() }}</div>
        </flux:card>
    </div>
</div>
