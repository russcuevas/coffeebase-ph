<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'grade',
        'flavor_notes',
        'origin',
        'cultivar',
        'harvest',
        'milling',
        'picking',
        'recommended_for',
        'storage',
        'primary_image',
        'gallery_images',
        'badge',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class)->orderBy('price', 'asc');
    }

    public function getMinPriceAttribute()
    {
        return $this->variants->min('price') ?? 0;
    }

    public function getMaxPriceAttribute()
    {
        return $this->variants->max('price') ?? 0;
    }

    public function getIsSoldOutAttribute()
    {
        if ($this->variants->isEmpty()) {
            return true;
        }
        return $this->variants->every(fn($v) => $v->is_sold_out || $v->stock_quantity <= 0);
    }

    public function getDefaultVariantAttribute()
    {
        return $this->variants->where('is_sold_out', false)->first() ?? $this->variants->first();
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
