<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'is_read',
        'admin_notes',
        'replied_by',
        'replied_at',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'replied_at' => 'datetime',
    ];

    public function repliedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    public function markAsRead(): void
    {
        $this->update([
            'is_read' => true,
            'status' => 'read'
        ]);
    }

    public function markAsUnread(): void
    {
        $this->update([
            'is_read' => false,
            'status' => 'new'
        ]);
    }

    public function archive(): void
    {
        $this->update(['status' => 'archived']);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'new' => 'bg-blue-100 text-blue-800',
            'read' => 'bg-green-100 text-green-800',
            'archived' => 'bg-gray-100 text-gray-800',
            default => $this->is_read
                ? 'bg-green-100 text-green-800'
                : 'bg-blue-100 text-blue-800',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new' => 'Nieuw',
            'read' => 'Gelezen',
            'archived' => 'Gearchiveerd',
            default => $this->is_read ? 'Gelezen' : 'Nieuw',
        };
    }

    public function isNew(): bool
    {
        return $this->status === 'new' || !$this->is_read;
    }
}
