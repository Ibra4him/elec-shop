<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasSlug, SoftDeletes, InteractsWithMedia;

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(600)
            ->height(600)
            ->nonQueued();
    }

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'description',
        'short_description',
        'base_price',
        'status',
        'is_featured',
        'meta_title',
        'meta_description',
        'has_variants',
        'sku',
        'stock_qty',
        'min_stock',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'has_variants' => 'boolean',
        'base_price' => 'decimal:2',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(ProductSpecification::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'actif');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    protected static function booted()
    {
        static::saved(function ($product) {
            if (!$product->has_variants) {
                // Synchroniser la variante par défaut pour les produits simples
                $product->variants()->updateOrCreate(
                    [], // On prend la première variante ou on en crée une
                    [
                        'sku' => $product->sku ?? 'SKU-' . $product->id,
                        'price' => $product->base_price,
                        'stock_qty' => $product->stock_qty,
                        'min_stock' => $product->min_stock,
                        'is_active' => true,
                    ]
                );
            }
        });
    }

    /**
     * Récupère la variante principale (la seule si simple, ou la première active)
     */
    public function getMainVariant()
    {
        if (!$this->has_variants) {
            return $this->variants->first();
        }

        return $this->variants->where('is_active', true)->first();
    }
}
