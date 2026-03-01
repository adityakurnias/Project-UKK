<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">Orders</flux:heading>
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Order ID</flux:table.column>
            <flux:table.column>Customer</flux:table.column>
            <flux:table.column>Status</flux:table.column>
            <flux:table.column>Total</flux:table.column>
            <flux:table.column>Date</flux:table.column>
            <flux:table.column>Actions</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($orders as $order)
                <flux:table.row>
                    <flux:table.cell>#{{ $order->id }}</flux:table.cell>
                    <flux:table.cell>{{ $order->user->name }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge
                            color="{{ match ($order->status) { 'completed' => 'green', 'cancelled' => 'red', 'shipped' => 'blue', 'processing' => 'zinc', default => 'yellow'} }}">
                            {{ ucfirst($order->status) }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>Rp {{ number_format($order->total_amount, 0) }}</flux:table.cell>
                    <flux:table.cell>{{ $order->created_at->format('M d, Y') }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:button size="sm" variant="ghost" href="{{ route('admin.orders.show', $order) }}"
                            wire:navigate>View</flux:button>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
