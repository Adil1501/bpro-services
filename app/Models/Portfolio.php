<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Portfolio extends Model
{
    protected $table = 'portfolio_projects';

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'before_image',
        'after_image',
        'location',
        'completed_at',
        'is_featured',
        'likes_count',
    ];

    protected $casts = [
        'completed_at' => 'date',
        'is_featured' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function portfolioLikes(): HasMany
    {
        return $this->hasMany(PortfolioLike::class, 'portfolio_project_id');
    }

    public function getBeforeImageUrlAttribute(): string
    {
        return Storage::url($this->before_image);
    }

    public function getAfterImageUrlAttribute(): string
    {
        return Storage::url($this->after_image);
    }

    public function isLikedByUser(int $userId): bool
    {
        return $this->portfolioLikes()
                    ->where('user_id', $userId)
                    ->exists();
    }
}
