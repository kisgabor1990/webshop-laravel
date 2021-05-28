<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Email cím megerősítése')
                ->greeting('Kedves ' . $notifiable->name . '!')
                ->line('Ön sikeresen regisztált ' . config('app.name') . ' oldalunkon!')
                ->line('Email címének megerősítéséhez kattintson az alábbi gombra.')
                ->action('Email cím megerősítése', $url)
                ->line('Ha nem Ön hozta létre ezt a fiókot, hagyja levelünket figyelmen kívül!')
                ->salutation('Üdvözlettel: ' . config('app.name') . ' csapata!');
        });
    }
}
