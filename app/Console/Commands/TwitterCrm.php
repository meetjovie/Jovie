<?php

namespace App\Console\Commands;

use App\Models\Creator;
use App\Models\Crm;
use App\Models\User;
use Illuminate\Console\Command;

class TwitterCrm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:import {network} {userEmail}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $network = $this->argument('network');
        $email = $this->argument('userEmail');

        $user = User::where('email', $email)->first();

        if (!is_null($user)) {
            if ($network == 'twitter') {
                $twitters = Creator::query()->whereNotNull('twitter_handler')->limit(100)->pluck('id')->toArray();
                $user->crms()->syncWithoutDetaching($twitters);
            }
        }
    }
}
