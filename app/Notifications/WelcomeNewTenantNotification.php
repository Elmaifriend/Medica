<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class WelcomeNewTenantNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        // Generamos un link seguro que expira en 24 horas
        $url = URL::temporarySignedRoute(
            'setup.password', 
            Carbon::now()->addHours(24),
            ['user' => $notifiable->id]
        );

        return (new MailMessage)
            ->subject('Bienvenido a ByteByte Studio - Configura tu cuenta')
            ->greeting('Hola ' . $notifiable->name . ',')
            ->line('Tu sistema ha sido creado exitosamente.')
            ->line('Para comenzar, necesitas definir una contraseña segura para este panel.')
            ->action('Crear mi Contraseña', $url)
            ->line('Este enlace caduca en 24 horas.');
    }
}