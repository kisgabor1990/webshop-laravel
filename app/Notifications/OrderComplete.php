<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderComplete extends Notification implements ShouldQueue
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
        $subtotal = 0;
        $message = new MailMessage;
        $message->subject("Sikeres rendelés!")
            ->greeting('Kedves ' . $notifiable->name . '!')
            ->line("Köszönjük rendelésed! Hamarosan elkezdjük a feldolgozását, melyről újabb email üzenetet kapsz.")
            ->line("Rendelés azonosítód: <strong>#" . str_pad($this->order->id, 6, '0', STR_PAD_LEFT) . "</strong>")
            ->line("Rendelés részletei:")
            ->line(
                "Rendelés dátuma: <strong>" . $this->order->created_at->format("Y. M d. H:i:s") . "</strong><br>"
                    . "Fizetési mód: <strong>" . $this->order->payment . "</strong><br>"
                    . "Átvétel módja: <strong>" . $this->order->shipping_mode . "</strong><br>"
                    . "Átvétel helye: <strong>" . $this->order->shipping->address->zip . " " . $this->order->shipping->address->city . ", " . $this->order->shipping->address->address . " " . $this->order->shipping->address->address2 . "</strong>"
            )
            ->line("Termékek:")
            ->line("<hr>");

        foreach ($this->order->products as $product) {
            $subtotal += $product->pivot->price * $product->pivot->quantity;
            $message
                ->line("<p style=\"text-align: center;\"><strong>" . $product->pivot->product_name . "</strong></p>")
                ->line("<p style=\"text-align: center;\"><img src=\"" . url($product->coverImage()->path) . "\" alt=\"" . $product['name'] . "\" style=\"max-width: 150px\" /></p>")
                ->line(
                    "<p style=\"text-align: center;\">Mennyiség: <strong>" . $product->pivot->quantity . " db.</strong><br>"
                        . "Egységár: <strong>" . number_format($product->pivot->price, 0, ',', ' ') . " Ft.</strong><br>"
                        . "Összesen: <strong>" . number_format($product->pivot->price * $product->pivot->quantity, 0, ',', ' ') . " Ft.</strong></p>"
                )
                ->line("<hr>");
        }

        $message
            ->line(
            "Részösszeg: <strong>" . number_format($subtotal, 0, ',', ' ') . " Ft.</strong><br>"
                . "Szállítás: <strong>" . number_format($this->order->shipping_price, 0, ',', ' ') . " Ft.</strong><br>"
            )
            ->line("Összesen: <strong>" . number_format($this->order->shipping_price + $subtotal, 0, ',', ' ') . " Ft.</strong>")
            ->line("<small>Ez egy automata visszaigazolás a megrendelés leadásáról, nem jelenti a szerződés létrejöttét.</small>");

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
