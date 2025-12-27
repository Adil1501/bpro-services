<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'username',
        'birthday',
        'profile_photo',
        'bio',
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
            'birthday' => 'date',
        ];
    }


    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }


    public function newsPosts()
    {
        return $this->hasMany(News::class, 'author_id');
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticketReplies()
    {
        return $this->hasMany(TicketReply::class);
    }

    public function likedProjects()
    {
        return $this->belongsToMany(PortfolioProject::class, 'portfolio_likes')
                    ->withTimestamps();
    }

    public function assignedQuotes(): HasMany
    {
    return $this->hasMany(Quote::class, 'assigned_to');
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            return Storage::url($this->profile_photo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&size=200&background=3B82F6&color=fff';
    }

    public function getAgeAttribute()
    {
        if (!$this->birthday) {
            return null;
        }

        return $this->birthday->age;
    }

    public function getDisplayNameAttribute()
    {
        return $this->username ?? $this->name;
    }
}
