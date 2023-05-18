<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\AttributesService;
use Illuminate\Console\Command;

class SetDefaultFieldsAttributes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attributes:default-fields {reset?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reset = $this->argument('reset');
        $users = User::query()->with('teams.userLists', 'teams.customFields')->get();
        foreach ($users as $user) {
            foreach ($user->teams as $team) {
                AttributesService::setAttributes($user, $team, $reset);
            }
        }
    }
}
