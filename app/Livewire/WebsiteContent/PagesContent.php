<?php

namespace App\Livewire\WebsiteContent;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Support\Str;

class PagesContent extends Component
{
    // List state
    public $search    = '';
    public $filterType = ''; // 'fixed' | 'dynamic' | ''

    // Form fields
    public $title           = '';
    public $slug            = '';
    public $content         = '';
    public $meta_title      = '';
    public $meta_description= '';
    public $is_active       = true;

    // State
    public $editingId          = null;
    public $showModal          = false;
    public $confirmingDeleteId = null;
    public $isFixedPage        = false;

    protected function rules()
    {
        return [
            'title'            => 'required|string|max:200',
            'slug'             => 'required|string|max:200|unique:pages,slug,' . ($this->editingId ?? 'NULL'),
            'content'          => 'nullable|string',
            'meta_title'       => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:500',
            'is_active'        => 'boolean',
        ];
    }

    public function updatedTitle($value)
    {
        if (!$this->editingId) {
            $this->slug = Str::slug($value);
        }
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->isFixedPage = false;
        $this->showModal   = true;
        $this->dispatch('modalOpened', content: ''); // ← Added
    }

    public function openEdit($id)
    {
        $page = Page::findOrFail($id);
        $this->editingId        = $page->id;
        $this->title            = $page->title;
        $this->slug             = $page->slug;
        $this->content          = $page->content ?? '';
        $this->meta_title       = $page->meta_title ?? '';
        $this->meta_description = $page->meta_description ?? '';
        $this->is_active        = $page->is_active;
        $this->isFixedPage      = $page->is_fixed;
        $this->showModal        = true;
        $this->dispatch('modalOpened', content: $page->content ?? ''); // ← Added
    }

    public function save()
    {
        $this->validate();

        $wasEditing = $this->editingId;

        Page::updateOrCreate(
            ['id' => $this->editingId],
            [
                'title'            => $this->title,
                'slug'             => $this->slug,
                'content'          => $this->content,
                'meta_title'       => $this->meta_title,
                'meta_description' => $this->meta_description,
                'is_active'        => $this->is_active,
                'is_fixed'         => $this->isFixedPage,
            ]
        );

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $wasEditing ? 'Page updated.' : 'Page created.');
    }

    public function toggleActive($id)
    {
        $page = Page::findOrFail($id);
        $page->update(['is_active' => !$page->is_active]);
    }

    public function confirmDelete($id)
    {
        $page = Page::findOrFail($id);
        if ($page->is_fixed) {
            session()->flash('error', 'Fixed pages cannot be deleted.');
            return;
        }
        $this->confirmingDeleteId = $id;
    }

    public function delete()
    {
        $page = Page::findOrFail($this->confirmingDeleteId);
        if (!$page->is_fixed) {
            $page->delete();
            session()->flash('success', 'Page deleted.');
        }
        $this->confirmingDeleteId = null;
    }

    private function resetForm()
    {
        $this->editingId        = null;
        $this->title            = '';
        $this->slug             = '';
        $this->content          = '';
        $this->meta_title       = '';
        $this->meta_description = '';
        $this->is_active        = true;
        $this->isFixedPage      = false;
        $this->resetErrorBag();
    }

    public function render()
    {
        $pages = Page::query()
            ->when($this->search, fn($q) =>
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('slug', 'like', "%{$this->search}%")
            )
            ->when($this->filterType === 'fixed',   fn($q) => $q->where('is_fixed', true))
            ->when($this->filterType === 'dynamic', fn($q) => $q->where('is_fixed', false))
            ->orderByRaw('is_fixed DESC')
            ->orderBy('title')
            ->get();

        return view('livewire.website-content.pages-content', compact('pages'))
            ->layout('layouts.admin');
    }
}