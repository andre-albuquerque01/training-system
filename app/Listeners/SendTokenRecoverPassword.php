<?php

namespace App\Listeners;

use App\Events\RecoverPasswordEvent;
use App\Mail\RecoverPasswordEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTokenRecoverPassword
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RecoverPasswordEvent $event): void
    {
        Mail::to($event->email)->send(new RecoverPasswordEmail([
            'toEmail' => $event->email,
            'subject' => 'Recuperar e-mail',
            'token' => $event->token,
            'expiration_hours' => "15 minutos"
        ]));
    }
}
