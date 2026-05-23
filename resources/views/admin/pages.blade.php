@extends('layouts.admin')

@section('title', 'Pages Content')

@section('content')
<div class="card">
    <div class="card-header">
        <i class="fas fa-file-alt me-2"></i>Pages Content Management
    </div>
    <div class="card-body">
        <div class="list-group">
            @foreach($pages ?? [] as $page)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-{{ $page->icon ?? 'file-alt' }} me-2 text-primary"></i>
                    {{ $page->title }}
                </div>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editPageModal{{ $page->id }}">
                    Edit Content
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Edit Page Modals -->
@foreach($pages ?? [] as $page)
<div class="modal fade" id="editPageModal{{ $page->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit {{ $page->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $page->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="10">{{ $page->content }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ $page->meta_title }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="2">{{ $page->meta_description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection