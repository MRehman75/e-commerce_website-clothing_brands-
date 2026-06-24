<?php
namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\BlogPost;

class BlogDetail extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $post = BlogPost::where('slug', $this->slug)
                    ->where('status', 'published')
                    ->firstOrFail();

        $post->increment('views');

        return view('livewire.frontend.blog-detail', compact('post'))
               ->layout('layouts.frontend');
    }
}