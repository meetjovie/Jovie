<?php

namespace App\Console\Commands;

use App\Models\Team;
use Illuminate\Console\Command;

class FreePlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'free-plan';

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
        $teams = Team::get();


        foreach ($teams as $team) {
            $currentSubscription = $team->currentSubscription();
            if (!($currentSubscription && $team->subscribed($currentSubscription->name))) {
                $team->credits += 10;
                $team->save();
            }
        }
    }
}
