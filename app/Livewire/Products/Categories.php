<?php
namespace App\Livewire\Products;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Categories extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $editingId = null;
    public $confirmingDeleteId = null;

    // Form fields
    public $name = '';
    public $slug = '';
    public $description = '';
    public $parent_id = '';
    public $order = 0;
    public $status = 'active';
    public $image;
    public $existingImage = '';

    protected $rules = [
        'name'        => 'required|string|max:100',
        'slug'        => 'required|string|max:100',
        'description' => 'nullable|string',
        'parent_id'   => 'nullable|exists:categories,id',
        'order'       => 'integer|min:0',
        'status'      => 'required|in:active,inactive',
        'image'       => 'nullable|image|max:1024',
    ];

    public function updatingSearch() { $this->resetPage(); }

    public function updatedName($value)
    {
        if (!$this->editingId) {
            $this->slug = Str::slug($value);
        }
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->dispatch('categoryModalOpened', content: ''); // ← Added
    }

    public function openEdit($id)
    {
        $cat = Category::findOrFail($id);
        $this->editingId     = $cat->id;
        $this->name          = $cat->name;
        $this->slug          = $cat->slug;
        $this->description   = $cat->description ?? '';
        $this->parent_id     = $cat->parent_id ?? '';
        $this->order         = $cat->order ?? 0;
        $this->status        = $cat->status;
        $this->existingImage = $cat->image ?? '';
        $this->showModal     = true;
        $this->dispatch('categoryModalOpened', content: $cat->description ?? ''); // ← Added
    }

   public function save()
{
    $this->validate();

    $data = [
        'name'        => $this->name,
        'slug'        => $this->slug,
        'description' => $this->description,
        'parent_id'   => $this->parent_id ?: null,
        'order'       => $this->order,
        'status'      => $this->status,
    ];

    if ($this->image) {
        $data['image'] = $this->image->store('categories', 'public');
    } else {
        $data['image'] = $this->existingImage ?: null;
    }

    if ($this->editingId) {
        Category::findOrFail($this->editingId)->update($data);
    } else {
        Category::create($data);
    }

    $this->showModal = false;
    $this->resetForm();
    session()->flash('success', $this->editingId ? 'Category updated.' : 'Category created.');
}

    public function confirmDelete($id) { $this->confirmingDeleteId = $id; }

    public function delete()
    {
        Category::findOrFail($this->confirmingDeleteId)->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Category deleted.');
    }

    private function resetForm()
    {
        $this->editingId = null;
        $this->name = $this->slug = $this->description = $this->existingImage = '';
        $this->parent_id = '';
        $this->order = 0;
        $this->status = 'active';
        $this->image = null;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.products.categories', [
            'categories' => Category::with('parent')
                ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
                ->orderBy('order')
                ->paginate(15),
            'parentCategories' => Category::whereNull('parent_id')->orderBy('name')->get(),
        ])->layout('layouts.admin');
    }
}