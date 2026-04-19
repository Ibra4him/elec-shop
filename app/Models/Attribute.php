<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Attribute extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'is_filterable',
        'is_visible',
        'position',
    ];

    protected $casts = [
        'is_filterable' => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function scopeFilterable($query)
    {
        return $query->where('is_filterable', true);
    }
}
