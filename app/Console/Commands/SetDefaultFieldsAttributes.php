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

                $customFieldIds = $team->customFields->pluck('id')->toArray();
                $defaultFieldIds = array_column(FieldAttribute::DEFAULT_FIELDS, 'id');

                $fieldIds = array_merge($defaultFieldIds, $customFieldIds);

                $defaultHeaderIds = array_column(FieldAttribute::DEFAULT_HEADERS, 'id');
                $fieldHeaderIds = array_merge($defaultHeaderIds, $customFieldIds);

                foreach ($fieldIds as $k => $fieldId) {
                    FieldAttribute::query()->updateOrCreate([
                        'field_id' => $fieldId,
                        'user_id' => $user->id,
                        'team_id' => $team->id,
                    ], [
                        'type' => is_numeric($fieldId) ? 'default' : 'custom',
                        'order' => $k
                    ]);
                }

                if ($team->owner_id == $user->id) {
                    foreach ($team->userLists as $list) {
                        foreach ($fieldHeaderIds as $k => $fieldId) {
                            FieldAttribute::query()->updateOrCreate([
                                'field_id' => $fieldId,
                                'user_list_id' => $list->id,
                            ], [
                                'user_id' => $user->id,
                                'team_id' => $team->id,
                                'type' => is_numeric($fieldId) ? 'default' : 'custom',
                                'order' => $k
                            ]);
                        }
                    }
                }
            }
        }
    }
}
