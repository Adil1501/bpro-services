<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'order',
    ];

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function portfolioProjects()
    {
        return $this->hasMany(Portfolio::class, 'category_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
