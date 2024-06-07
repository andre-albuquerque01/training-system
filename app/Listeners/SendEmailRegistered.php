<?php

namespace App\Listeners;

use App\Events\Registered;
use App\Mail\VerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class SendEmailRegistered
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
    public function handle(Registered $event): void
    {
        Mail::to($event->email)->send(new VerifyEmail([
            'toEmail' => $event->email,
            'subject' => 'Verificação de e-mail',
            'message' => $event->id,
            'token' => $event->token
        ]));
    }
}
