<div>
    <div class="container py-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ $page->title }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-4 mb-4" style="font-family: 'Playfair Display', serif;">
                    {{ $page->title }}
                </h1>
                <div class="content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</div>