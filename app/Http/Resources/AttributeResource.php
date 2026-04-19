<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
            'values' => $this->values->map(fn($v) => [
                'id' => $v->id,
                'value' => $v->value,
                'color_code' => $v->color_code,
            ]),
        ];
    }
}
