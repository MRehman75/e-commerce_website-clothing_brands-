<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if($post->featured_image)
            <img src="{{ asset('storage/' . $post->featured_image) }}"
                 class="img-fluid rounded mb-4 w-100" style="max-height:400px;object-fit:cover;">
            @endif

            <h1 class="mb-3">{{ $post->title }}</h1>

            <div class="text-muted small mb-4">
                <i class="fas fa-calendar me-1"></i>
                {{ \Carbon\Carbon::parse($post->published_at)->format('d M Y') }}
                <span class="ms-3">
                    <i class="fas fa-eye me-1"></i>{{ $post->views }} views
                </span>
            </div>

            <div class="blog-content">
                {!! $post->content !!}
            </div>

            <hr class="my-4">
            <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">
                ← Wapas Blog Pe
            </a>
        </div>
    </div>
</div>