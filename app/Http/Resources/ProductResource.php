<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'base_price' => (float) $this->base_price,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'variants' => ProductVariantResource::collection($this->whenLoaded('variants')),
            'specifications' => $this->specifications->map(fn($s) => [
                'key' => $s->key,
                'value' => $s->value,
            ]),
            'images' => $this->getMedia('product_images')->map(fn($media) => [
                'url' => $media->getUrl(),
                'thumb' => $media->getUrl('thumb'),
            ]),
            'is_featured' => $this->is_featured,
            'rating_avg' => round($this->reviews_avg_rating ?? 0, 1),
            'reviews_count' => $this->reviews_count ?? 0,
        ];
    }
}
