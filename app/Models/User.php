<?php
namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable
{
    use HasFactory, Notifiable, LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string $slug): bool
    {
        return $this->roles->contains('slug', $slug);
    }

    // ── Orders relationship ──────────────────────────
   public function orders()
{
    return $this->hasMany(Order::class, 'user_id');
}

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "User {$eventName}");
    }


    // app/Models/User.php mein add karo

// public function hasPermission(string $slug): bool
// {
//     // Super Admin ko sab permission mile (agar role "super-admin" hai)
//     foreach ($this->roles as $role) {
//         if ($role->slug === 'super-admin') {
//             return true;
//         }
//         if ($role->permissions->contains('slug', $slug)) {
//             return true;
//         }
//     }
//     return false;
// }

// public function hasRole(string $slug): bool
// {
//     return $this->roles->contains('slug', $slug);
// }
}