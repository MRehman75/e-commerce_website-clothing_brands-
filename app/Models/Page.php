<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'content',
        'meta_title', 'meta_description',
        'is_fixed', 'is_active',
    ];

    protected $casts = [
        'is_fixed'  => 'boolean',
        'is_active' => 'boolean',
    ];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
    }
}