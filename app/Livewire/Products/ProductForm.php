<?php

namespace App\Livewire\Products;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ProductForm extends Component
{
    use WithFileUploads;

    public $productId = null;

    // Basic
    public $name = '';
    public $slug = '';
    public $sku = '';
    public $description = '';
    public $status = 'active';
    public $featured = false;

    // Pricing
    public $price = 0;
    public $compare_price = '';

    // Stock
    public $stock = 0;

    // Media
    public $image;
    public $existingImage = '';
    public $gallery = [];
    public $existingGallery = [];

    // Relations
    public $category_id = '';
    public $brand_id = '';

    // SEO
    public $seo_title = '';
    public $seo_description = '';

    protected function rules()
    {
        return [
            'name'            => 'required|string|max:200',
            'slug'            => 'required|string|max:200|unique:products,slug,' . ($this->productId ?? 'NULL'),
            'sku'             => 'nullable|string|max:100|unique:products,sku,' . ($this->productId ?? 'NULL'),
            'description'     => 'nullable|string',
            'price'           => 'required|numeric|min:0',
            'compare_price'   => 'nullable|numeric|min:0',
            'stock'           => 'required|integer|min:0',
            'category_id'     => 'nullable|exists:categories,id',
            'brand_id'        => 'nullable|exists:brands,id',
            'status'          => 'required|in:active,inactive,draft',
            'featured'        => 'boolean',
            'image'           => ($this->productId ? 'nullable' : 'nullable') . '|image|max:2048',
            'seo_title'       => 'nullable|string|max:200',
            'seo_description' => 'nullable|string|max:500',
        ];
    }

    public function mount($productId = null)
    {
        $this->productId = $productId;

        if ($productId) {
            $product = Product::findOrFail($productId);
            $this->name             = $product->name;
            $this->slug             = $product->slug;
            $this->sku              = $product->sku ?? '';
            $this->description      = $product->description ?? '';
            $this->price            = $product->price;
            $this->compare_price    = $product->compare_price ?? '';
            $this->stock            = $product->stock;
            $this->category_id      = $product->category_id ?? '';
            $this->brand_id         = $product->brand_id ?? '';
            $this->status           = $product->status;
            $this->featured         = $product->featured;
            $this->existingImage    = $product->image ?? '';
            $this->existingGallery  = $product->gallery ?? [];
            $this->seo_title        = $product->seo_title ?? '';
            $this->seo_description  = $product->seo_description ?? '';
        }
    }

    public function updatedName($value)
    {
        if (!$this->productId) {
            $this->slug = Str::slug($value);

            // SKU auto-generate — sirf tab jab user ne manually nahi likha
            if (empty($this->sku)) {
                $this->sku = $this->generateSku($value);
            }
        }
    }

    public function regenerateSku()
    {
        $this->sku = $this->generateSku($this->name);
    }

    private function generateSku(string $name): string
    {
        $words  = array_filter(explode(' ', strtoupper(trim($name))));
        $prefix = implode('-', array_map(fn($w) => substr($w, 0, 3), array_slice($words, 0, 3)));
        $suffix = strtoupper(substr(uniqid(), -4));

        return $prefix ? "{$prefix}-{$suffix}" : 'SKU-' . $suffix;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name'            => $this->name,
            'slug'            => $this->slug,
            'sku'             => $this->sku ?: null,
            'description'     => $this->description,
            'price'           => $this->price,
            'compare_price'   => $this->compare_price ?: null,
            'stock'           => $this->stock,
            'category_id'     => $this->category_id ?: null,
            'brand_id'        => $this->brand_id ?: null,
            'status'          => $this->status,
            'featured'        => $this->featured,
            'gallery'         => $this->existingGallery,
            'seo_title'       => $this->seo_title,
            'seo_description' => $this->seo_description,
        ];

        // Handle main image
        if ($this->image) {
            $data['image'] = $this->image->store('products', 'public');
        } else {
            $data['image'] = $this->existingImage;
        }

        // Handle gallery
        if (!empty($this->gallery)) {
            $galleryPaths = $this->existingGallery;
            foreach ($this->gallery as $img) {
                $galleryPaths[] = $img->store('products/gallery', 'public');
            }
            $data['gallery'] = $galleryPaths;
        }

        if ($this->productId) {
            Product::findOrFail($this->productId)->update($data);
            session()->flash('success', 'Product updated successfully.');
        } else {
            Product::create($data);
            session()->flash('success', 'Product created successfully.');
        }

        return $this->redirect(route('admin.products.all'), navigate: true);
    }

    public function removeGalleryImage($index)
    {
        array_splice($this->existingGallery, $index, 1);
    }

    public function render()
    {
        return view('livewire.products.add-product', [
            'categories' => Category::orderBy('name')->get(),
            'brands'     => Brand::orderBy('name')->get(),
        ])->layout('layouts.admin');
    }
}