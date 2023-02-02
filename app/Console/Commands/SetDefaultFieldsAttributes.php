<?php

namespace App\Console\Commands;

use App\Models\FieldAttribute;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SetDefaultFieldsAttributes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attributes:default-fields';

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
        foreach (User::query()->with('teams')->get() as $user) {
            foreach ($user->teams as $team) {
                foreach (FieldAttribute::DEFAULT_FIELDS as $k => $field) {
                    FieldAttribute::query()->updateOrCreate([
                        'field_id' => $field['id'],
                        'user_id' => $user->id,
                        'team_id' => $team->id,
                    ], [
                        'type' => 'default',
                        'order' => $k
                    ]);
                }
            }
        }
    }
}
