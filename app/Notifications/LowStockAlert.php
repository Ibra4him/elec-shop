<?php

namespace App\Notifications;

use App\Models\ProductVariant;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LowStockAlert extends Notification
{
    use Queueable;

    protected $variant;

    /**
     * Create a new notification instance.
     */
    public function __construct(ProductVariant $variant)
    {
        $this->variant = $variant;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->error()
                    ->subject('Alerte Stock Bas : ' . $this->variant->product->name)
                    ->line('Le stock pour la variante ' . $this->variant->sku . ' est tombé en dessous du seuil minimum.')
                    ->line('Stock actuel : ' . $this->variant->stock_qty)
                    ->line('Seuil minimum : ' . $this->variant->min_stock)
                    ->action('Gérer le Stock', url('/admin/products/' . $this->variant->product_id . '/edit'))
                    ->line('Veuillez réapprovisionner ce produit dès que possible.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'variant_id' => $this->variant->id,
            'sku' => $this->variant->sku,
            'product_name' => $this->variant->product->name,
            'current_stock' => $this->variant->stock_qty,
            'min_stock' => $this->variant->min_stock,
        ];
    }
}
