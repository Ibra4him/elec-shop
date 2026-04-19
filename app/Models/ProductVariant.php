<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'sku',
        'price',
        'promo_price',
        'cost_price',
        'stock_qty',
        'min_stock',
        'weight',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'promo_price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'weight' => 'decimal:3',
        'is_active' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'variant_attributes', 'variant_id', 'attribute_value_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'variant_id');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class, 'variant_id');
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class, 'variant_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_qty', '>', 0);
    }

    public function adjustStock(int $quantity, string $type, ?string $reason = null, ?string $reference = null)
    {
        StockMovement::create([
            'variant_id' => $this->id,
            'quantity' => $quantity,
            'type' => $type,
            'reason' => $reason,
            'reference' => $reference,
            'user_id' => auth()->id(),
        ]);

        if ($type === 'entree' || $type === 'retour') {
            $this->increment('stock_qty', abs($quantity));
        } elseif ($type === 'sortie') {
            $this->decrement('stock_qty', abs($quantity));
        } elseif ($type === 'ajustement') {
            $this->stock_qty = $quantity;
            $this->save();
        }
    }
}
