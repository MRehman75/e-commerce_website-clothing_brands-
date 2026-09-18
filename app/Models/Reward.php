<?php
// app/Models/Reward.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'user_id',
        'points',
        'membership_level',
        'lifetime_spent',
        'reviews_count',
        'orders_count'
    ];

    protected $casts = [
        'points' => 'integer',
        'lifetime_spent' => 'decimal:2',
        'reviews_count' => 'integer',
        'orders_count' => 'integer',
    ];

    // ============ RELATIONSHIPS ============
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ============ ACCESSORS ============
    
    public function getLevelColorAttribute()
    {
        $colors = [
            'bronze' => '#CD7F32',
            'silver' => '#C0C0C0',
            'gold' => '#C9A227',
            'platinum' => '#E5E4E2',
        ];
        return $colors[$this->membership_level] ?? '#C9A227';
    }

    public function getLevelBadgeClassAttribute()
    {
        $classes = [
            'bronze' => 'bg-secondary',
            'silver' => 'bg-secondary',
            'gold' => 'bg-warning',
            'platinum' => 'bg-info',
        ];
        return $classes[$this->membership_level] ?? 'bg-secondary';
    }

    public function getNextLevelAttribute()
    {
        $levels = ['bronze', 'silver', 'gold', 'platinum'];
        $currentIndex = array_search($this->membership_level, $levels);
        return $levels[$currentIndex + 1] ?? null;
    }

    public function getPointsToNextLevelAttribute()
    {
        $thresholds = [
            'bronze' => 0,
            'silver' => 500,
            'gold' => 1500,
            'platinum' => 3000,
        ];
        $levels = array_keys($thresholds);
        $currentIndex = array_search($this->membership_level, $levels);
        $nextLevel = $levels[$currentIndex + 1] ?? null;
        
        if ($nextLevel) {
            return max(0, $thresholds[$nextLevel] - $this->points);
        }
        return 0;
    }

    public function getProgressPercentageAttribute()
    {
        $thresholds = [
            'bronze' => 0,
            'silver' => 500,
            'gold' => 1500,
            'platinum' => 3000,
        ];
        $levels = array_keys($thresholds);
        $currentIndex = array_search($this->membership_level, $levels);
        $nextLevel = $levels[$currentIndex + 1] ?? null;
        
        if ($nextLevel) {
            $current = $this->points - $thresholds[$this->membership_level];
            $total = $thresholds[$nextLevel] - $thresholds[$this->membership_level];
            return min(100, round(($current / $total) * 100));
        }
        return 100;
    }

    // ============ HELPERS ============
    
    public function addPoints($points)
    {
        $this->increment('points', $points);
        $this->updateMembershipLevel();
        return $this;
    }

    public function deductPoints($points)
    {
        $this->decrement('points', $points);
        $this->updateMembershipLevel();
        return $this;
    }

    private function updateMembershipLevel()
    {
        $levels = [
            'platinum' => 3000,
            'gold' => 1500,
            'silver' => 500,
            'bronze' => 0,
        ];
        
        foreach ($levels as $level => $points) {
            if ($this->points >= $points) {
                $this->update(['membership_level' => $level]);
                break;
            }
        }
    }
}