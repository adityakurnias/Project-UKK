<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;
use Livewire\WithFileUploads; // Added this line
use Illuminate\Support\Facades\Storage; // Added this line for Storage facade

#[Layout('layouts.app')]
class Form extends Component
{
    use WithFileUploads; // Added this line

    public ?Product $product = null;

    public $name = '';
    public $category_id = '';
    public $description = '';
    public $price = '';
    public $stock = '';
    public $is_active = true;

    // Temporary basic support for image URI strings instead of full file upload
    public $image; // Changed from $image_path to $image for file upload
    public $image_path = ''; // Kept for displaying existing image path

    public function mount(?Product $product = null)
    {
        if ($product && $product->exists) {
            $this->product = $product;
            $this->name = $product->name;
            $this->category_id = $product->category_id;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->stock = $product->stock;
            $this->image_path = $product->image_path; // Still used for existing image path
            $this->is_active = $product->is_active;
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048', // 2MB Max // Changed validation for image upload
            'is_active' => 'boolean',
        ]);

        if ($this->image) {
            if ($this->product && $this->product->image_path) {
                Storage::disk('public')->delete($this->product->image_path);
            }
            $validated['image_path'] = $this->image->store('products', 'public');
        }

        unset($validated['image']); 

        if (!$this->product) {
            $validated['slug'] = Str::slug($this->name);
            Product::create($validated);
        } else {
            if ($this->name !== $this->product->name) {
                $validated['slug'] = Str::slug($this->name);
            }
            $this->product->update($validated);
        }

        return redirect()->route('admin.products.index')->with('success', 'Product saved successfully.');
    }

    public function render()
    {
        return view('livewire.admin.product.form', [
            'categories' => Category::all()
        ]);
    }
}
