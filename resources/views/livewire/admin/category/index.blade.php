<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">Categories</flux:heading>
        <flux:button variant="primary" href="{{ route('admin.categories.create') }}" wire:navigate>Add Category
        </flux:button>
    </div>

    @if (session()->has('success'))
        <div class="rounded-md bg-green-50 dark:bg-green-900/30 p-4">
            <div class="flex">
                <div class="shrink-0">
                    <flux:icon name="check-circle" class="h-5 w-5 text-green-400" />
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <flux:table>
        <flux:table.columns>
            <flux:table.column>Name</flux:table.column>
            <flux:table.column>Slug</flux:table.column>
            <flux:table.column>Active</flux:table.column>
            <flux:table.column>Actions</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($categories as $category)
                <flux:table.row>
                    <flux:table.cell>{{ $category->name }}</flux:table.cell>
                    <flux:table.cell>{{ $category->slug }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:badge color="{{ $category->is_active ? 'green' : 'red' }}">
                            {{ $category->is_active ? 'Yes' : 'No' }}
                        </flux:badge>
                    </flux:table.cell>
                    <flux:table.cell>
                        <flux:button size="sm" variant="ghost" href="{{ route('admin.categories.edit', $category) }}"
                            wire:navigate>Edit</flux:button>
                        <flux:button size="sm" variant="danger" wire:click="delete({{ $category->id }})"
                            wire:confirm="Are you sure you want to delete this category?">Delete</flux:button>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>
</div>
