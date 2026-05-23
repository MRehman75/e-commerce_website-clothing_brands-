<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'content',
        'featured_image', 'status', 'is_featured',
        'allow_comments', 'meta_title', 'meta_description',
        'meta_keywords', 'views', 'published_at',
    ];

    protected $casts = [
        'is_featured'    => 'boolean',
        'allow_comments' => 'boolean',
        'published_at'   => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}