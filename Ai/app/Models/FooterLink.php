<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FooterLink extends Model
{
    protected $fillable = [
        'footer_column_id', 'label', 'url',
        'open_in_new_tab', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'open_in_new_tab' => 'boolean',
    ];

    public function column(): BelongsTo
    {
        return $this->belongsTo(FooterColumn::class, 'footer_column_id');
    }
}