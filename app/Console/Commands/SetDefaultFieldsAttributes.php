<?php

namespace App\Console\Commands;

use App\Models\CustomField;
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
        foreach (User::query()->with('teams.userLists', 'teams.customFields')->get() as $user) {
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

                if ($team->owner_id == $user->id) {

                    $customFieldIds = $team->customFields->pluck('id')->toArray();
                    $defaultIds = array_column(FieldAttribute::DEFAULT_HEADERS, 'id');

                    $fieldIds = array_merge($defaultIds, $customFieldIds);
                    foreach ($team->userLists as $list) {
                        foreach ($fieldIds as $k => $fieldId) {
                            FieldAttribute::query()->updateOrCreate([
                                'field_id' => $fieldId,
                                'user_list_id' => $list->id,
                            ], [
                                'user_id' => $user->id,
                                'team_id' => $team->id,
                                'type' => 'default',
                                'order' => $k
                            ]);
                        }
                    }
                }
            }
        }
    }
}
