<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNewUser extends Notification implements ShouldQueue
{
    use Queueable;

    public $password;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
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
        return (new MailMessage)
                    ->subject("Felhasználói fiókja elkészült!")
                    ->greeting("Kedves " . $notifiable->name . "!")
                    ->line("Felhasználói fiókja sikeresen elkészült!")
                    ->line("Bejelentkezési adatok:")
                    ->line(
                        "E-mail cím: <strong>" . $notifiable->email . "</strong><br>"
                        . "Ideiglenes jelszó: <strong>" . $this->password . "</strong>"
                    )
                    ->line("Felhívjuk figyelmét, hogy bejelentkezést követően jelszavát meg kell változtatnia!")
                    ->action("Bejelentkezés", url("/bejelentkezes"));
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
