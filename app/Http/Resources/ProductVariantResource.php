<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'price' => (float) $this->price,
            'promo_price' => $this->promo_price ? (float) $this->promo_price : null,
            'stock_qty' => $this->stock_qty,
            'attributes' => $this->attributeValues->map(fn($v) => [
                'attribute' => $v->attribute->name,
                'value' => $v->value,
            ]),
        ];
    }
}
