<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class ProductFilterService
{
    public function filter(array $filters): Builder
    {
        $query = Product::query()->active();

        if (!empty($filters['category'])) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('slug', $filters['category']);
            });
        }

        if (!empty($filters['brand'])) {
            $query->whereHas('brand', function ($q) use ($filters) {
                $q->where('slug', $filters['brand']);
            });
        }

        if (isset($filters['min_price'])) {
            $query->whereHas('variants', function ($q) use ($filters) {
                $q->where('price', '>=', $filters['min_price']);
            });
        }

        if (isset($filters['max_price'])) {
            $query->whereHas('variants', function ($q) use ($filters) {
                $q->where('price', '<=', $filters['max_price']);
            });
        }

        if (!empty($filters['attributes']) && is_array($filters['attributes'])) {
            foreach ($filters['attributes'] as $attributeSlug => $values) {
                $query->whereHas('variants.attributeValues', function ($q) use ($attributeSlug, $values) {
                    $q->whereHas('attribute', function ($attrQ) use ($attributeSlug) {
                        $attrQ->where('slug', $attributeSlug);
                    })->whereIn('value', (array) $values);
                });
            }
        }

        if (!empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query;
    }
}
