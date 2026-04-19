<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'subtotal',
        'tax_amount',
        'shipping_amount',
        'status',
        'delivery_address',
        'payment_method',
        'payment_status',
        'notes',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_amount' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = 'ORD-' . strtoupper(Str::random(10));
        });

        static::updating(function ($order) {
            // Automatically confirm the order if it's paid and was still pending
            if ($order->isDirty('payment_status') && $order->payment_status === 'payee' && $order->status === 'en_attente') {
                $order->status = 'confirmee';
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->items->sum('total_price');
        $this->total_amount = $this->subtotal + $this->tax_amount + $this->shipping_amount;
        $this->save();
    }
}
