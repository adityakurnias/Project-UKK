<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">{{ $category ? 'Edit Category' : 'Create Category' }}</flux:heading>
        <flux:button variant="ghost" href="{{ route('admin.categories.index') }}" wire:navigate>Back to Categories
        </flux:button>
    </div>

    <flux:card>
        <form wire:submit="save" class="space-y-6">
            <flux:input wire:model="name" label="Category Name" placeholder="e.g. Processors" required />

            <flux:textarea wire:model="description" label="Description" placeholder="Optional description..."
                rows="4" />

            <flux:checkbox wire:model="is_active" label="Active"
                description="If inactive, this category won't show in the storefront." />

            <div class="flex justify-end pt-4 gap-2 border-t border-zinc-200 dark:border-zinc-700">
                <flux:button variant="ghost" href="{{ route('admin.categories.index') }}" wire:navigate>Cancel
                </flux:button>
                <flux:button variant="primary" type="submit">Save Category</flux:button>
            </div>
        </form>
    </flux:card>
</div>
