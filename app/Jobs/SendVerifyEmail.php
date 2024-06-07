<?php

namespace App\Jobs;

use App\Events\Registered;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendVerifyEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $email;
    private string $id;
    private string $token;

    /**
     * Create a new job instance.
     */
    public function __construct(string $email, string $id, string $token)
    {
        $this->email = $email;
        $this->id = $id;
        $this->token = $token;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        event(new Registered($this->email, $this->id, $this->token));
    }
}
