<?php
namespace App\Livewire\WebsiteContent;

use App\Models\BlogPost;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPosts extends Component
{
    use WithFileUploads, WithPagination;

    // Form fields
    public $title, $excerpt, $content;
    public $meta_title, $meta_description, $meta_keywords;
    public $status        = 'draft';
    public $is_featured   = false;
    public $allow_comments = true;
    public $published_at  = '';
    public $featured_image;
    public $existingImage = '';

    // State
    public $editingId          = null;
    public $showModal          = false;
    public $confirmingDeleteId = null;

    // Filters
    public $search      = '';
    public $filterStatus = '';

    protected function rules()
    {
        return [
            'title'            => 'required|string|max:200',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'nullable|string',
            'status'           => 'required|in:draft,published,scheduled',
            'is_featured'      => 'boolean',
            'allow_comments'   => 'boolean',
            'published_at'     => 'nullable|date',
            'meta_title'       => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords'    => 'nullable|string|max:200',
            'featured_image'   => ($this->editingId ? 'nullable' : 'nullable') . '|mimes:jpg,jpeg,png,webp,gif,svg|max:3048',
        ];
    }

    public function openCreate()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->dispatch('blogModalOpened', content: ''); // ← Added
    }

    public function openEdit($id)
    {
        $post = BlogPost::findOrFail($id);
        $this->editingId       = $post->id;
        $this->title           = $post->title;
        $this->excerpt         = $post->excerpt;
        $this->content         = $post->content;
        $this->status          = $post->status;
        $this->is_featured     = $post->is_featured;
        $this->allow_comments  = $post->allow_comments;
        $this->published_at    = $post->published_at?->format('Y-m-d') ?? '';
        $this->meta_title      = $post->meta_title;
        $this->meta_description = $post->meta_description;
        $this->meta_keywords   = $post->meta_keywords;
        $this->existingImage   = $post->featured_image;
        $this->showModal       = true;
        $this->dispatch('blogModalOpened', content: $post->content ?? ''); // ← Added
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title'            => $this->title,
            'slug'             => Str::slug($this->title),
            'excerpt'          => $this->excerpt,
            'content'          => $this->content,
            'status'           => $this->status,
            'is_featured'      => $this->is_featured,
            'allow_comments'   => $this->allow_comments,
            'published_at'     => $this->published_at ?: null,
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'meta_keywords'    => $this->meta_keywords,
        ];

        if ($this->featured_image) {
            if ($this->existingImage) {
                Storage::disk('public')->delete($this->existingImage);
            }
            $data['featured_image'] = $this->featured_image->store('blog', 'public');
        } else {
            $data['featured_image'] = $this->existingImage;
        }

        $wasEditing = $this->editingId;
        BlogPost::updateOrCreate(['id' => $this->editingId], $data);

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', $wasEditing ? 'Post updated.' : 'Post added.');
    }

    public function toggleFeatured($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->update(['is_featured' => !$post->is_featured]);
    }

    public function toggleStatus($id)
    {
        $post = BlogPost::findOrFail($id);
        $post->update([
            'status' => $post->status === 'published' ? 'draft' : 'published'
        ]);
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete()
    {
        $post = BlogPost::findOrFail($this->confirmingDeleteId);
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $post->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Post deleted.');
    }

    private function resetForm()
    {
        $this->editingId        = null;
        $this->title            = '';
        $this->excerpt          = '';
        $this->content          = '';
        $this->status           = 'draft';
        $this->is_featured      = false;
        $this->allow_comments   = true;
        $this->published_at     = '';
        $this->meta_title       = '';
        $this->meta_description = '';
        $this->meta_keywords    = '';
        $this->featured_image   = null;
        $this->existingImage    = '';
        $this->resetErrorBag();
    }

    public function render()
    {
        $posts = BlogPost::query()
            ->when($this->search, fn($q) =>
                $q->where('title', 'like', '%' . $this->search . '%')
            )
            ->when($this->filterStatus, fn($q) =>
                $q->where('status', $this->filterStatus)
            )
            ->latest()
            ->paginate(10);

        return view('livewire.website-content.blog-posts', [
            'posts' => $posts,
        ])->layout('layouts.admin');
    }
}