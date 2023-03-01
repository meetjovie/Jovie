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
        foreach (User::query()->with('teams.userLists', 'teams.customFields')->get() as $user) {
            foreach ($user->teams as $team) {

                $customFields = $team->customFields;
                $defaultFieldIds = array_column(FieldAttribute::DEFAULT_FIELDS, 'id');

                $fieldIds = array_merge($defaultFieldIds, $customFields->pluck('id')->toArray());

                $defaultHeaders = FieldAttribute::DEFAULT_HEADERS;
                $fieldHeaders = array_merge($defaultHeaders, $customFields->toArray());

                foreach ($fieldIds as $k => $fieldId) {
                    $data = [
                        'type' => is_numeric($fieldId) ? 'default' : 'custom',
                    ];
                    if (! $reset) {
                        $data['order'] = $k;
                    }
                    FieldAttribute::query()->updateOrCreate([
                        'field_id' => $fieldId,
                        'user_id' => $user->id,
                        'team_id' => $team->id,
                    ], $data);
                }

                if ($team->owner_id == $user->id) {
                    foreach ($team->userLists as $list) {
                        foreach ($fieldHeaders as $k => $fieldHeader) {
                            $data = [
                                'user_id' => $user->id,
                                'team_id' => $team->id,
                                'type' => is_numeric($fieldHeader['id']) ? 'default' : 'custom',
                                'hide' => array_key_exists('hide', $fieldHeader) ? $fieldHeader['hide'] : false
                            ];
                            if (! $reset) {
                                $data['order'] = $k;
                            }
                            FieldAttribute::query()->updateOrCreate([
                                'field_id' => $fieldHeader['id'],
                                'user_list_id' => $list->id,
                            ], [
                                'user_id' => $user->id,
                                'team_id' => $team->id,
                                'type' => is_numeric($fieldHeader['id']) ? 'default' : 'custom',
                                'order' => $k,
                                'hide' => array_key_exists('hide', $fieldHeader) ? $fieldHeader['hide'] : false
                            ]);
                        }
                    }
                }
            }
        }
    }
}
