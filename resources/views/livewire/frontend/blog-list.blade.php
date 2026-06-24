<div class="container py-5">
    <h2 class="mb-4"><i class="fas fa-blog me-2"></i>Blog Posts</h2>
    <div class="row g-4">
        @forelse($posts as $post)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                @if($post->featured_image)
                <img src="{{ asset('storage/' . $post->featured_image) }}"
                     class="card-img-top" style="height:200px;object-fit:cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="text-muted small">{{ $post->excerpt }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}"
                       class="btn btn-sm btn-primary">Read More →</a>
                </div>
                <div class="card-footer text-muted small">
                    <i class="fas fa-calendar me-1"></i>
                    {{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}
                    <span class="ms-2">
                        <i class="fas fa-eye me-1"></i>{{ $post->views }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
            <p>Koi post nahi mili!</p>
        </div>
        @endforelse
    </div>
    <div class="mt-4">{{ $posts->links() }}</div>
</div>