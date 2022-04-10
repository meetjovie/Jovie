<?php

namespace App\Jobs;

use App\Models\Creator;
use App\Models\User;
use App\Notifications\ImportNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSlackNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $message = null;
    private $internalMessage = null;
    private $data = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $internalMessage = '', $data = [])
    {
        $this->message = $message;
        $this->internalMessage = $internalMessage;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $user = new User();
            $user->notify(new ImportNotification($this->message, $this->internalMessage, $this->data));
        } catch (\Exception $e) {

        }
    }
}
