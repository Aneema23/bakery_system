<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    public function __construct(private readonly Order $order)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $status = strtolower((string) $this->order->status);
        $message = match ($status) {
            'processing' => 'Your order has been confirmed and is being prepared.',
            'completed' => 'Your order is ready.',
            'delivered' => 'Your order has been delivered.',
            'cancel' => 'Your order has been cancelled.',
            default => 'Your order status is now ' . ucfirst($status) . '.',
        };

        return [
            'order_id' => $this->order->id,
            'status' => $status,
            'message' => $message,
        ];
    }
}