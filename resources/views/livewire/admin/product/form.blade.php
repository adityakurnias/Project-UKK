<div class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading size="xl">{{ $product ? 'Edit Product' : 'Create Product' }}</flux:heading>
        <flux:button variant="ghost" href="{{ route('admin.products.index') }}" wire:navigate>Back to Products
        </flux:button>
    </div>

    <flux:card>
       <form wire:submit.prevent="save" enctype="multipart/form-data" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input wire:model="name" label="Product Name" placeholder="e.g. Intel Core i9" required />

                <flux:select wire:model="category_id" label="Category" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </flux:select>

                <flux:input type="number" wire:model="price" label="Price (Rp)" placeholder="e.g. 150000" min="0"
                    required />

                <flux:input type="number" wire:model="stock" label="Stock" placeholder="e.g. 50" min="0" required />
            </div>

            <flux:textarea wire:model="description" label="Description" placeholder="Detailed product description..."
                rows="4" />

            <div class="space-y-4">
                <div>
                    <flux:label>Product Image</flux:label>
                    <input type="file" wire:model="image" accept="image/*"
                        class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:text-zinc-400 dark:file:bg-zinc-800 dark:file:text-zinc-300 border border-zinc-200 dark:border-zinc-700 p-1.5 rounded-md" />
                    @error('image') <span class="text-sm text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                @if ($image)
                    <div class="mt-2 text-sm text-zinc-500">
                        File uploaded securely. Wait for preview...
                    </div>
                    <div class="mt-2">
                        <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Image Preview:</p>
                        <img src="{{ $image->temporaryUrl() }}"
                            class="w-32 h-32 object-cover rounded shadow-sm border border-zinc-200 dark:border-zinc-700">
                    </div>
                @elseif ($image_path)
                    <div class="mt-2">
                        <p class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Current Image:</p>
                        <img src="{{ asset('storage/' . $image_path) }}"
                            class="w-32 h-32 object-cover rounded shadow-sm border border-zinc-200 dark:border-zinc-700">
                    </div>
                @endif
            </div>

            <flux:checkbox wire:model="is_active" label="Active"
                description="If inactive, this product won't show in the storefront." />

            <div class="flex justify-end pt-4 gap-2 border-t border-zinc-200 dark:border-zinc-700">
                <flux:button variant="ghost" href="{{ route('admin.products.index') }}" wire:navigate>Cancel
                </flux:button>
                <flux:button variant="primary" type="submit">Save Product</flux:button>
            </div>
        </form>
    </flux:card>
</div>
