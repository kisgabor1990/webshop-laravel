<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNewOrder extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage;

        $message->subject("Új megrendelés!")
        ->greeting('Kedves ' . $notifiable->name . '!')
        ->line("Új megrendelés érkezett!")
        ->line("Rendelés azonosítója: <strong>#" . str_pad($this->order->id, 6, '0', STR_PAD_LEFT) . "</strong>")
        ->line("Rendelés részletei:")
        ->line(
            "Rendelés dátuma: <strong>" . $this->order->created_at->format("Y. M d. H:i:s") . "</strong><br>"
                . "Fizetési mód: <strong>" . $this->order->payment . "</strong><br>"
                . "Átvétel módja: <strong>" . $this->order->shipping_mode . "</strong><br>"
                . "Átvétel helye: <strong>" . $this->order->shipping->address->zip . " " . $this->order->shipping->address->city . ", " . $this->order->shipping->address->address . " " . $this->order->shipping->address->address2 . "</strong>"
        )
        ->line("A rendeléshez fűzött megjegyzés: <strong>" . $this->order->comment . "</strong>")
        ->line("Megrendelt termékek:")
        ->line("<hr>");

        foreach ($this->order->products as $product) {
            $message
                ->line("<p style=\"text-align: center;\"><strong>" . $product->pivot->product_name . "</strong></p>")
                ->line("<p style=\"text-align: center;\"><img src=\"" . url($product->coverImage()->path) . "\" alt=\"" . $product['name'] . "\" style=\"max-width: 150px\" /></p>")
                ->line("<p style=\"text-align: center;\">Mennyiség: <strong>" . $product->pivot->quantity . " db.</strong></p>")
                ->line("<hr>");
        }

        $message
            ->line("A megrendelés visszaigazolásához kattintson az alábbi gombra: ")
            ->action("Visszaigazolás", url("/"))
            ->line("Visszaigazolás után megkezdheti a termék(ek) összekészítését.");

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
