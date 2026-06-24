<?php
namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BlogPost;

class BlogList extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = BlogPost::where('status', 'published')
                    ->orderBy('published_at', 'desc')
                    ->paginate(9);

        return view('livewire.frontend.blog-list', compact('posts'))
               ->layout('layouts.frontend');
    }
}