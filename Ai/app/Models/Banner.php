<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'subtitle', 'image', 'link',
        'open_in_new_tab', 'position',
        'starts_at', 'ends_at',
        'sort_order', 'is_active',
    ];

    protected $casts = [
        'is_active'        => 'boolean',
        'open_in_new_tab'  => 'boolean',
        'starts_at'        => 'date',
        'ends_at'          => 'date',
    ];

    // Positions list — reuse everywhere
    public static function positions(): array
    {
        return [
            'homepage_top'    => 'Homepage — Top',
            'homepage_middle' => 'Homepage — Middle',
            'homepage_bottom' => 'Homepage — Bottom',
            'category_top'    => 'Category Page — Top',
            'sidebar'         => 'Sidebar',
            'popup'           => 'Popup',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(fn($q) => $q->whereNull('starts_at')->orWhere('starts_at', '<=', Carbon::today()))
            ->where(fn($q) => $q->whereNull('ends_at')->orWhere('ends_at', '>=', Carbon::today()));
    }

    public function scopeForPosition($query, string $position)
    {
        return $query->where('position', $position)->orderBy('sort_order');
    }

    // Check if banner is currently running
    public function getIsRunningAttribute(): bool
    {
        $today = Carbon::today();
        $afterStart = !$this->starts_at || $this->starts_at->lte($today);
        $beforeEnd  = !$this->ends_at   || $this->ends_at->gte($today);
        return $this->is_active && $afterStart && $beforeEnd;
    }

    public function getPositionLabelAttribute(): string
    {
        return static::positions()[$this->position] ?? $this->position;
    }
}