<?php

namespace App\Jobs;

use App\Events\RecoverPasswordEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecoverPasswordSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $email;
    private string $token;

    /**
     * Create a new job instance.
     */
    public function __construct(string $email, string $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new RecoverPasswordEvent($this->email, $this->token));
    }
}
