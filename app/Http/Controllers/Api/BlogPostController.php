<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreBlogPostRequest;
use App\Http\Requests\Api\UpdateBlogPostRequest;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('is_featured')) {
            $query->where('is_featured', filter_var($request->is_featured, FILTER_VALIDATE_BOOLEAN));
        }
        if ($request->filled('search')) {
            $query->where(fn($q) => $q
                ->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('excerpt', 'like', '%' . $request->search . '%')
            );
        }

        $query->orderBy('created_at', 'desc');
        $perPage = min((int) $request->get('per_page', 15), 100);

        return BlogPostResource::collection($query->paginate($perPage));
    }

    public function store(StoreBlogPostRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        if (empty($data['published_at']) && ($data['status'] ?? '') === 'published') {
            $data['published_at'] = now();
        }

        $post = BlogPost::create($data);

        return response()->json([
            'message' => 'Blog post ban gaya!',
            'data'    => new BlogPostResource($post),
        ], 201);
    }

    public function show(BlogPost $blogPost): JsonResponse
    {
        $blogPost->increment('views');
        return response()->json(['data' => new BlogPostResource($blogPost)]);
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $blogPost): JsonResponse
    {
        $data = $request->validated();
        if (!empty($data['status']) && $data['status'] === 'published' && !$blogPost->published_at) {
            $data['published_at'] = now();
        }

        $blogPost->update($data);

        return response()->json([
            'message' => 'Blog post update ho gaya!',
            'data'    => new BlogPostResource($blogPost->fresh()),
        ]);
    }

    public function destroy(BlogPost $blogPost): JsonResponse
    {
        $blogPost->delete();
        return response()->json(['message' => 'Blog post delete ho gaya!']);
    }

    public function toggle(BlogPost $blogPost): JsonResponse
    {
        $newStatus = $blogPost->status === 'published' ? 'draft' : 'published';
        $blogPost->update(['status' => $newStatus]);

        return response()->json([
            'message' => "Blog post {$newStatus} ho gaya!",
            'data'    => new BlogPostResource($blogPost->fresh()),
        ]);
    }
}