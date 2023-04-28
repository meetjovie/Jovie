<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportContactFromSocial implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $handle;
    protected $network;
    private $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($handle, $network, $params)
    {
        $this->handle = $handle;
        $this->network = $network;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $creators = null;
        if ($this->network == 'instagram') {
            $creators = (new InstagramImport($this->handle, $this->params['tags'] ?? null, true, null, $this->params['meta'] ?? null))->handle();
        } elseif ($this->network == 'twitter') {
            $creators = (new TwitterImport($this->handle, $this->params['tags'] ?? null, $this->params['meta'] ?? null))->handle();
        } elseif ($this->network == 'tiktok') {
            $creators = (new TiktokImport($this->handle, $this->params['tags'] ?? null, $this->params['meta'] ?? null))->handle();
        } elseif ($this->network == 'twitch') {
            $creators = (new TwitchImport(null, $this->handle, $this->params['tags'] ?? null, $this->params['meta'] ?? null))->handle();
        }
        return $creators;
    }
}
