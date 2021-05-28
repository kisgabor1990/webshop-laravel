<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
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
            
            ResetPassword::toMailUsing(function($user, $token) {
                return (new MailMessage)
                ->subject('Új jelszó beállítása')
                ->greeting('Kedves ' . $user->name . '!')
                ->line('Azért kapta ezt az emailt, mert Ön, vagy valaki az Ön email címével új jelszót igényelt oldalunkon.')
                ->action('Új jelszó', url('uj-jelszo', [$token, $user->email]))
                ->line('Az új jelszó beállításához szükséges link ' . config('auth.passwords.'.config('auth.defaults.passwords').'.expire') . ' percig érvényes.')
                ->line('Ha nem Ön kezdeményezte az új jelszó kérését, akkor további teendője nincs.')
                ->salutation('Üdvözlettel: ' . config('app.name') . ' csapata!');
        });
    }
}
