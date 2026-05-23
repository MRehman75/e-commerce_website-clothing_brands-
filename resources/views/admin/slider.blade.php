@extends('layouts.admin')

@section('title', 'Slider Management')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-images me-2"></i>Home Slider Management
    </div>
    <div class="card-body">
        <button class="btn btn-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#addSlideModal">
            <i class="fas fa-plus"></i> Add New Slide
        </button>
        
        @forelse($sliders ?? [] as $slider)
        <div class="slider-item">
            <div class="d-flex align-items-center gap-3">
                <div class="slider-image">
                    @if($slider->image)
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px;">
                    @else
                        <i class="fas fa-image fa-2x text-secondary"></i>
                    @endif
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-1">{{ $slider->title }}</h6>
                    <small class="text-muted">{{ $slider->description }}</small>
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSlideModal{{ $slider->id }}">Edit</button>
                    <button class="btn btn-sm btn-outline-danger" onclick="deleteSlide({{ $slider->id }})">Delete</button>
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-info">No slides found. Click "Add New Slide" to create one.</div>
        @endforelse
    </div>
</div>

<!-- Add Slide Modal -->
<div class="modal fade" id="addSlideModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Slide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link (Optional)</label>
                        <input type="url" name="link" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Order</label>
                        <input type="number" name="order" class="form-control" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Slide</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function deleteSlide(id) {
    if(confirm('Are you sure you want to delete this slide?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush