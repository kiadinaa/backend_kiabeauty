<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'brand',
        'description',
        'category_id',
        'price',
        'discount_percent',
        'img',
        'stock',
        'slug',
    ];

    protected $appends = [
        'final_price',
        'has_discount',
        'rating_average',
        'image_url',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
            'category_id'
        );
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(
            Review::class,
            'product_id',
            'product_id'
        )->latest();
    }

    public function getFinalPriceAttribute(): float
    {
        if ($this->discount_percent > 0) {
            return round((float) $this->price * (1 - ($this->discount_percent / 100)), 2);
        }

        return (float) $this->price;
    }

    public function getHasDiscountAttribute(): bool
    {
        return (int) $this->discount_percent > 0;
    }

    public function getRatingAverageAttribute(): float
    {
        $avg = $this->reviews()->avg('rating');

        return $avg ? round((float) $avg, 1) : 4.8;
    }

    public function getReviewsCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    public function getImageUrlAttribute(): string
    {
        if (! $this->img) {
            return asset('images/products/somethinc-cleanser.jpg');
        }

        if (str_starts_with($this->img, 'http://') || str_starts_with($this->img, 'https://')) {
            return $this->img;
        }

        if (str_starts_with($this->img, 'products/')) {
            return asset('storage/'.$this->img);
        }

        return asset($this->img);
    }
}
