<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'company_name',
        'service_id',
        'message',
        'address',
        'city',
        'postal_code',
        'surface_area',
        'preferred_date',
        'urgency',
        'images',
        'status',
        'assigned_to',
        'admin_notes',
        'quoted_price',
        'quote_details',
        'quote_valid_until',
    ];

    protected $casts = [
        'images' => 'array',
        'preferred_date' => 'date',
        'quote_valid_until' => 'date',
        'quoted_price' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(QuoteComment::class);
    }

    public function getCustomerNameAttribute(): string
    {
        return $this->name;
    }

    public function getCustomerEmailAttribute(): string
    {
        return $this->email;
    }

    public function getCustomerPhoneAttribute(): string
    {
        return $this->phone;
    }

    public function getDescriptionAttribute(): string
    {
        return $this->message ?? '';
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Nieuw',
            'reviewed' => 'In Behandeling',
            'approved' => 'Goedgekeurd',
            'rejected' => 'Afgewezen',
            default => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-blue-100 text-blue-800',
            'reviewed' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getUrgencyColorAttribute(): string
    {
        return match($this->urgency ?? 'normal') {
            'low' => 'bg-gray-100 text-gray-800',
            'normal' => 'bg-blue-100 text-blue-800',
            'high' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
