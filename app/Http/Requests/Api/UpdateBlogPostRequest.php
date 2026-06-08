<?php
namespace App\Http\Requests\Api;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'title'            => 'sometimes|string|max:255',
            'slug'             => 'nullable|string|max:255|unique:blog_posts,slug,' . $this->blogPost?->id,
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'sometimes|string',
            'featured_image'   => 'nullable|string|max:500',
            'status'           => 'nullable|in:draft,published,archived',
            'is_featured'      => 'boolean',
            'allow_comments'   => 'boolean',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords'    => 'nullable|string|max:500',
            'published_at'     => 'nullable|date',
        ];
    }
}