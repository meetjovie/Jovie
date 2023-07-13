<?php

namespace App\Http\Controllers;

use App\Events\EnrichedContactDataViewed;
use App\Exports\CrmExport;
use App\Jobs\ImportFromSocialAndAddTOCrm;
use App\Models\Contact;
use App\Models\ContactComment;
use App\Models\Creator;
use App\Models\CreatorComment;
use App\Models\Crm;
use App\Models\CustomFieldValue;
use App\Models\Template;
use App\Models\User;
use App\Models\UserList;
use App\Services\ContactService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use MeiliSearch\Client;
use OwenIt\Auditing\Events\AuditCustom;

class CrmController extends Controller
{
    public function crmContacts(Request $request)
    {
        $params = $request->all();
        $params['user_id'] = Auth::id();
        $params['team_id'] = Auth::user()->currentTeam->id;
        $contacts = Contact::getContacts($params);
        $counts = Contact::getCrmCounts();
        $limitExceedBy = Auth::user()->currentTeam->contactsLimitExceeded();
        $totalAvailable = Contact::getAllContactsCount();
        $stages = isset($params['list']) ? UserList::getListStages($params['list']) : UserList::getListStages();
        return response()->json([
            'status' => true,
            'limit_exceeded_by' => $limitExceedBy,
            'total_available' => $totalAvailable,
            'contacts' => $contacts,
            'counts' => $counts,
            'networks' => Creator::NETWORKS,
            'stages' => $stages,
        ], 200);
    }

    public function stagedContacts(Request $request)
    {
        $params = $request->all();
        $params['user_id'] = Auth::id();
        $params['team_id'] = Auth::user()->currentTeam->id;
        if ($request->input('list')) {
            $params['type'] = 'list';
            $params['list'] = $request->input('list');
        }
        $contacts = Contact::getContacts($params, true);
        $counts = Contact::getCrmCounts();
        $limitExceedBy = Auth::user()->currentTeam->contactsLimitExceeded();
        $totalAvailable = Contact::getAllContactsCount();
        $stages = isset($params['list']) ? UserList::getListStages($params['list']) : UserList::getListStages();
        return response()->json([
            'status' => true,
            'limit_exceeded_by' => $limitExceedBy,
            'total_available' => $totalAvailable,
            'contacts' => $contacts,
            'counts' => $counts,
            'networks' => Creator::NETWORKS,
            'stages' => $stages,
        ], 200);
    }

    public function crmCounts()
    {
        $counts = Contact::getCrmCounts();
        return response()->json([
            'status' => true,
            'counts' => $counts
        ], 200);
    }

    public function updateContact(Request $request, $id)
    {
        $team_id = Auth::user()->currentTeam->id;
        $validator = Validator::make(
            ['id' => $id, 'team_id' => $team_id],
            ['id' => 'exists:contacts,id,team_id,' . $team_id]
        );
        if ($validator->fails()) {
            return collect([
                'status' => false,
                'data' => 'Invalid team',
            ]);
        }
        // update creator
        $params = $request->all();
        $params['user_id'] = Auth::id();
        $params['team_id'] = $team_id;
        Contact::updateContact($params, $id);
        $params['id'] = $id;
        return collect([
            'status' => true,
            'data' => Contact::getContacts($params)->first(),
        ]);
    }

    public function updateCopiedContactColumns(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => [
                'required',
                Rule::exists('contacts', 'id')->where(function ($query) {
                    $query->where('team_id', Auth::user()->currentTeam->id);
                })
            ],
        ]);

        if ($validator->fails()) {
            return collect([
                'status' => false,
                'data' => 'Invalid team',
            ]);
        }
        $params = $request->all();
        $ids = $params['ids'];
        unset($params['ids']);
        $params = [
            $params['key'] => $params['value']
        ];
        Contact::updateCopiedContactColumns($params, $ids);
        return collect([
            'status' => true,
        ]);
    }

    public function toggleContactsFromList(Request $request)
    {
        $list = UserList::where('id', $request->list)->first();
        if (!$list) {
            throw ValidationException::withMessages([
                'list' => ['List does not exists']
            ]);
        }

        $request->validate([
            'contact_ids' => 'required'
        ]);

        $contactIds = is_array($request->contact_ids) ? $request->contact_ids : [$request->contact_ids];

        $contacts = Contact::query()->select(['id', 'team_id'])->whereIn('id', $contactIds)->get();

        foreach ($contacts as $contact) {
            if ($request->remove) {
                $contact->auditDetach('userLists', [$list->id]);
            } else {
                Contact::addContactsToList($contact['id'], $list->id, $contact['team_id']);
            }
        }
        return response()->json([
            'status' => true,
            'list' => [
                'id' => $list->id,
                'name' => $list->name,
                'emoji' => $list->emoji,
            ],

            'message' => ('Contacts ' . ($request->remove == true ? 'removed from list' : 'added to list'))

        ], 200);
    }

    public function toggleArchiveContacts(Request $request)
    {
        $request->validate([
            'contact_ids' => 'required'
        ]);
        $contactIds = is_array($request->contact_ids) ? $request->contact_ids : [$request->contact_ids];
        Contact::updateArchivedStatus($contactIds, boolval($request->archived));
        return response()->json([
            'status' => true,
            'message' => ('Contacts ' . boolval($request->archived) ? 'archived.' : 'unarchived.')
        ], 200);
    }

    public function markEnrichedViewed(Contact $contact)
    {
        if ($contact->team_id == Auth::user()->team_id) {
            return response()->json([
                'status' => false,
                'message' => 'Contact does not exist.'
            ], 200);
        }
        $contact->enriched_viewed = true;
        $contact->save();
        EnrichedContactDataViewed::dispatch($contact->id, $contact->team_id);
        return response()->json([
            'status' => true,
            'message' => 'Marked Viewed.'
        ], 200);
    }

    public function overview(Request $request)
    {
        $params['user_id'] = Auth::id();
        $params['team_id'] = Auth::user()->currentTeam->id;
        $params['id'] = $request->id;
        $params['type'] = 'list';
        $params['list'] = $request->listId;
        $contact = Contact::getContacts($params)->first();

        if ($contact) {
            return collect([
                'status' => true,
                'contact' => $contact,
                'networks' => Creator::NETWORKS,
                'stages' => Crm::stages(),
            ]);
        }
        return collect([
            'status' => false,
        ]);
    }

    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'contact_id' => 'required|exists:contacts,id',
        ]);
        $comment = ContactComment::create([
            'user_id' => Auth::id(),
            'team_id' => Auth::user()->currentTeam->id,
            'contact_id' => $request->contact_id,
            'comment' => $request->comment,
        ]);

        return response([
            'status' => true,
            'message' => 'Comment added.',
            'data' => $comment->load('user'),
        ]);
    }

    public function getComments(Request $request, $contactId)
    {
        $comments = ContactComment::with('user')
            ->where('contact_id', $contactId)
            ->latest();
        if ($request->limit) {
            $comments = $comments->limit($request->limit);
        }
        $comments = $comments->get();

        return response([
            'status' => true,
            'comments' => $comments,
        ]);
    }

    public function nextContact($id)
    {
        $contact = Contact::where('id', '<', $id)->where('archived', 0)->where('user_id', Auth::id())->orderByDesc(
            'id'
        )->first();
        if ($contact) {
            return response([
                'status' => true,
                'data' => $contact,
            ]);
        }

        return response([
            'status' => false,
            'data' => null,
            'message' => 'No more contacts.',
        ]);
    }

    public function previousContact($id)
    {
        $contact = Contact::where('id', '>', $id)->where('archived', 0)->where('user_id', Auth::id())->first();
        if ($contact) {
            return response([
                'status' => true,
                'data' => $contact,
            ]);
        }

        return response([
            'status' => false,
            'data' => null,
            'message' => 'No more contacts.',
        ]);
    }

    public function checkContactEnrichable(Request $request)
    {
        $request->validate([
            'contact_ids' => 'required',
            'contact_ids.*' => 'exists:contacts,id',
        ]);

        $contacts = Contact::getEnrichableContacts($request->contact_ids);
        if ($count = count($contacts)) {
            if (!Auth::user()->currentTeam->hasEnoughEnrichingCredits($count)) {
                return response([
                    'status' => false,
                    'message' => "You do not have enough credits."
                ]);
            }

            return response([
                'status' => true,
                'data' => $contacts->pluck('id')->toArray(),
                'message' => "There are " . $count . " contacts that can be enriched. Are you sure you want to continue ?"
            ]);
        }
        return response([
            'status' => false,
            'message' => 'The selected contact/contacts does not have any social handles and thus can not be enriched.',
        ]);
    }

    public function enrichContacts(Request $request)
    {
        $request->validate([
            'contact_ids' => 'required',
            'contact_ids.*' => 'exists:contacts,id',
        ]);

        $params['user_id'] = Auth::id();
        $params['team_id'] = Auth::user()->currentTeam->id;

        if (!Auth::user()->currentTeam->hasEnoughEnrichingCredits(count($request->contact_ids))) {
            return response([
                'status' => false,
                'message' => "You do not have enough credits."
            ]);
        }
        Auth::user()->currentTeam->deductCredits(count($request->contact_ids));
        $enrichingContactIds = Contact::enrichContacts($request->contact_ids, $params);

        return response([
            'status' => true,
            'message' => "Enriching your contacts",
            'data' => $enrichingContactIds
        ]);
    }

    public function checkListsEnrichable(Request $request)
    {
        $request->validate([
            'list_ids' => 'required',
            'list_ids.*' => 'exists:user_lists,id',
        ]);

        $count = Contact::getEnrichableContactsFromLists($request->list_ids, true);
        if ($count) {
            if (!Auth::user()->currentTeam->hasEnoughEnrichingCredits($count)) {
                return response([
                    'status' => false,
                    'message' => "You do not have enough credits."
                ]);
            }

            return response([
                'status' => true,
                'data' => $count,
                'message' => "There are " . $count . " contact/contacts in the list/lists that can be enriched. Are you sure you want to continue ?"
            ]);
        }
        return response([
            'status' => false,
            'message' => 'The selected list/lists does not have any contacts with social handles and thus can not be enriched.',
        ]);
    }

    public function enrichLists(Request $request)
    {
        $request->validate([
            'list_ids' => 'required',
            'list_ids.*' => 'exists:user_lists,id',
        ]);

        $params['user_id'] = Auth::id();
        $params['team_id'] = Auth::user()->currentTeam->id;

        $count = Contact::getEnrichableContactsFromLists($request->list_ids, true);
        if (!Auth::user()->currentTeam->hasEnoughEnrichingCredits($count)) {
            return response([
                'status' => false,
                'message' => "You do not have enough credits."
            ]);
        }

        Auth::user()->currentTeam->deductCredits($count);
        $listIds = Contact::enrichLists($request->list_ids, $params);

        return response([
            'status' => true,
            'message' => "Enriching your lists",
            'data' => $listIds
        ]);
    }

    public function contactChangeLog(Request $request, $id)
    {
        $contact = Contact::where('id', $id)->first();
        if ($contact) {
            $history = $contact->audits()->with('user')->latest()->paginate(5);
            foreach ($history as &$change) {
                $userListIdsDB = UserList::query()->pluck('id')->toArray();
                $modifications = $change->getModified();
                $modificationTexts = [];
                foreach ($modifications as $key => $modified) {
                    $key = Str::replace('_', ' ', $key);
                    if ($key == 'favourite') {
                        if ($modified['new']) {
                            $modificationTexts[] = "contact moved to <b>favourites</b>.";
                        } else {
                            $modificationTexts[] = "contact removed from <b>favourites</b>.";
                        }
                    } elseif ($key == 'archived') {
                        if ($modified['new']) {
                            $modificationTexts[] = "contact moved to <b>archived</b>.";
                        } else {
                            $modificationTexts[] = "contact removed from <b>archived</b>.";
                        }
                    } elseif ($key == 'muted') {
                        if ($modified['new']) {
                            $modificationTexts[] = "contact <b>muted</b>.";
                        } else {
                            $modificationTexts[] = "contact <b>un-muted</b>.";
                        }
                    } elseif ($key == 'userLists') {
                        $removedValues = array_diff(
                            array_column($modified['old'], 'id'),
                            array_column($modified['new'], 'id')
                        );
                        $addedValues = array_diff(
                            array_column($modified['new'], 'id'),
                            array_column($modified['old'], 'id')
                        );

                        if (count($removedValues)) {
                            $userLists = array_filter($modified['old'], function ($value) use ($removedValues) {
                                return in_array($value['id'], $removedValues);
                            });
                            foreach ($userLists as $userList) {
                                $class = '';
                                if (!in_array($userList['id'], $userListIdsDB)) {
                                    $class = 'text-red-600';
                                }
                                $modificationTexts[] = "removed from list <b class='$class'>$userList[name]</b>";
                            }
                        }
                        if (count($addedValues)) {
                            $userLists = array_filter($modified['new'], function ($value) use ($addedValues) {
                                return in_array($value['id'], $addedValues);
                            });
                            foreach ($userLists as $userList) {
                                $class = '';
                                if (!in_array($userList['id'], $userListIdsDB)) {
                                    $class = 'text-red-600';
                                }
                                $modificationTexts[] = "added to list <b class='$class'>$userList[name]</b>";
                            }
                        }
                    } elseif ($key == 'customFields') {
                        foreach ($modified['new'] as $field => $value) {
                            if (is_array($value)) {
                                $customField = array_key_first($value);
                                $modificationTexts[] = ("updated " . $customField . ($modified['old'][$field][$customField] ? " from <b>" . $modified['old'][$field][$customField] : "") . "</b> to <b>" . $modified['new'][$field][$customField] . "</b>");
                            } else {
                                $readableField = Str::replace('_', ' ', $field);
                                $old = is_array($modified['old'][$field]) ? implode(
                                    ', ',
                                    $modified['old'][$field]
                                ) : $modified['old'][$field];
                                $new = is_array($value) ? implode(', ', $value) : $value;
                                if (!$old) {
                                    $modificationTexts[] = ("updated $readableField to <b>" . $new . "</b>");
                                } else {
                                    $modificationTexts[] = ("updated $readableField from <b>" . $old . "</b> to <b>" . $new . "</b>");
                                }
                            }
                        }
                    } elseif (isset($modified['old'])) {
                        $modificationTexts[] = ("updated $key from <b>" . $modified['old'] . "</b> to <b>" . $modified['new'] . "</b>");
                    } else {
                        if (is_array($modified['new'])) {
                            foreach ($modified['new'] as $new) {
                                $modificationTexts[] = ("updated $key to <b>" . $new['name'] . "</b>");
                            }
                        } else {
                            $modificationTexts[] = ("updated $key to <b>" . $modified['new'] . "</b>");
                        }
                    }
                }
                $change->modification_texts = $modificationTexts;
                unset($change->auditable);
            }
            if (!$history->hasMorePages()) {
                $history->push([
                    'modification_texts' => ['added this <b>contact</b>'],
                    'user' => $contact->user,
                ]);
            }
            return response([
                'status' => true,
                'data' => $history,
            ]);
        }
        return response([
            'status' => false,
            'data' => 'Contact does not exist.',
        ]);
    }

    public function suggestMerge(Request $request, ContactService $contactService)
    {
        $request->validate([
            'contact_ids' => 'sometimes',
            'contact_ids.*' => 'exists:contacts,id',
        ]);

        $params['user_id'] = Auth::id();
        $params['team_id'] = Auth::user()->currentTeam->id;
        $params['type'] = 'list';
        $params['list'] = $request->listId;
        $params['contact_ids'] = $request->contact_ids;

        $mergeSuggestions = $contactService->findDuplicates($params);

        $message = 'Here are your merge suggestions.';
        if (is_null($mergeSuggestions)) {
            $message = 'There are no merge suggestions.';
        }
        return response([
            'status' => true,
            'message' => $message,
            'data' => $mergeSuggestions
        ]);
    }

    public function mergeContacts(Request $request, ContactService $contactService)
    {
        try {
            $contact = $contactService->mergeContacts($request);

            return response()->json([
                'status' => true,
                'creator' => $contact,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => ($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine())
            ], 200);
        }
    }

    public function getExtensionCreator(Request $request)
    {
        try {
            $contact = Creator::getCrmCreatorByHandler($request->all());
            if ($contact) {
                return response()->json([
                    'status' => true,
                    'contact' => $contact,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => ($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine())
            ], 200);
        }
    }

    public function moveCreator(Request $request, $creatorId)
    {
        $data = $request->validate([
            'selected' => 'required|numeric',
            'rejected' => 'required|numeric',
        ]);
        $user = User::with('currentTeam')->where('id', Auth::id())->first();
        $data['team_id'] = $user->currentTeam->id;
        $crm = Crm::updateOrCreate(
            ['creator_id' => $creatorId, 'user_id' => $user->id, 'team_id' => $user->currentTeam->id],
            $data
        );
        Creator::where('id', $creatorId)->searchable();

        return response([
            'status' => true,
            'data' => $crm,
            'message' => 'Contact moved.',
        ]);
    }

    public function exportCrm(Request $request)
    {
        $params = $request->all();
        $params['team_id'] = Auth::user()->currentTeam->id;
        $params['export'] = true;
        $exportContent = Contact::getExportContacts($params);

        return Excel::download(new CrmExport($exportContent['contacts'], $exportContent['custom_headings']), 'contacts.csv');
    }

    public function addCreatorToCreator(Request $request)
    {
        $request->validate([
            'creator_id' => 'required',
        ]);

        $user = User::with('currentTeam')->where('id', Auth::id())->first();
        $crm = Crm::updateOrCreate(
            ['user_id' => $user->id, 'team_id' => $user->currentTeam->id, 'creator_id' => $request->creator_id],
            ['user_id' => $user->id, 'team_id' => $user->currentTeam->id, 'creator_id' => $request->creator_id]
        );

        return response([
            'status' => true,
            'message' => 'Added to contacts.',
            'crm' => $crm,
        ]);
    }

    public function discovery(Request $request)
    {
        $data = $this->fetchCreators($request, [], $request->page);

        return $data;
    }

    public function fetchCreators($request, $crms = null, $page = 1, $iteration = 1)
    {
        $creators = \App\Models\Creator::search($request->q);

        $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));

        $filtersString = '(mutedRecord!=user_' . Auth::id() . ' OR mutedRecordCount = 0)';

        $filtersString .= ' AND (selectedRecord!=user_' . Auth::id() . ' OR selectedRecordCount=0)';
        $filtersString .= ' AND (rejectedRecord!=user_' . Auth::id() . ' OR rejectedRecordCount=0)';
//        dd($filtersString);
        if (!empty($request->gender)) {
            $filtersString = $filtersString . ' AND gender=' . $request->gender;
        }
        if (!empty($request->instagram_category)) {
            $filtersString = $filtersString . ' AND instagram_category=' . $request->instagram_category;
        }
        if (!empty($request->city)) {
            $filtersString = $filtersString . ' AND city=' . $request->city;
        }
        if (!empty($request->country)) {
            $filtersString = $filtersString . ' AND country=' . $request->country;
        }

        $request->instagram_engagement_rate = json_decode($request->instagram_engagement_rate);
        if ($request->instagram_engagement_rate) {
            if (!empty($request->instagram_engagement_rate[0])) {
                $filtersString = $filtersString . ' AND instagram_engagement_rate>=' . ($request->instagram_engagement_rate[0] / 100);
            }
            if (!empty($request->instagram_engagement_rate[1])) {
                $filtersString = $filtersString . ' AND instagram_engagement_rate<=' . ($request->instagram_engagement_rate[1] / 100);
            }
        }
        $request->instagram_followers = json_decode($request->instagram_followers);
        if ($request->instagram_followers) {
            if (!empty($request->instagram_followers[0])) {
                $filtersString = $filtersString . ' AND instagram_followers>=' . $request->instagram_followers[0];
            }
            if (!empty($request->instagram_followers[1])) {
                $filtersString = $filtersString . ' AND instagram_followers<=' . $request->instagram_followers[1];
            }
        }

        if (!empty($request->emails)) {
            $filtersString = $filtersString . ' AND emails=' . $request->emails;
        }

        //dd($filtersString);
        dd($client->index('creators')->getSearchableAttributes());
        $data = $client->index('creators')->search($request->q, [
            'filter' => $filtersString,
            'offset' => $request->page,
            'limit' => 30,
        ])->getRaw();
        dd($data);

        if (!$crms) {
            $crms = $client->index('crms')->search('', [
                'filter' => ('selected=' . $request->selected . ' AND rejected=' . $request->rejected),
                'offset' => $request->page,
                'limit' => 30,
            ])->getRaw();
            $crms = \App\Models\Crm::search('')
                ->where('user_id', 1)
                ->where('selected', $request->selected)
                ->where('rejected', $request->rejected)
                ->take(PHP_INT_MAX)
                ->raw();
        }
        $crms = collect($crms['hits']);
        $crmCreatorIds = $crms->pluck('creator_id')->toArray();

        $hits = [];
        foreach ($creators['hits'] as $creator) {
            $tempCreator = $creator;
            if (in_array($creator['id'], $crmCreatorIds)) {
                $crm = $crms->where('creator_id', $creator['id'])->first();
                $muted = $crm['muted'];
                if ($muted) {
                    continue;
                } else {
                    $tempCreator['crm'] = $crm;
                }
            }
        }

        $creators['hits'] = $hits;

        return $creators;
    }

    public function saveToCrm(Request $request)
    {
        try {
            $user = User::currentLoggedInUser();

            $data = $request->except('network');
            $data = array_filter($data);
            $creator = Creator::query()->where(
                ($request->network . '_handler'),
                $request->{$request->network . '_handler'}
            )->first();
            $creator = $creator ?? new Creator();
            if (!empty($data['profile_pic_url']) && $request->network == 'instagram') {
                $profilePicUrl = $data['profile_pic_url'];
                unset($data['profile_pic_url']);
                $fileName = explode('/tmp/', $profilePicUrl)[1] ?? null;
                if ($fileName) {
                    Storage::disk('s3')->copy(
                        ('tmp/' . $fileName),
                        (Creator::CREATORS_CSV_PATH . $fileName)
                    );
                    $data['profile_pic_url'] = Storage::disk('s3')->url(Creator::CREATORS_CSV_PATH . $fileName);
                }
            }
            $meta = $creator->{$request->network . '_meta'};
            if (isset($data['profile_pic_url'])) {
                $meta->profile_pic_url = $data['profile_pic_url'];
            }
            $creator->{$request->network . '_meta'} = $meta;

            unset($data['profile_pic_url']);
            foreach ($data as $k => $v) {
                if ($k == 'meta') {
                    foreach ($v as $kk => $vv) {
                        if (!Schema::hasColumn('creators', $kk)) {
                            continue;
                        }
                        $creator->{$kk} = $vv;
                    }
                } else {
                    if (!Schema::hasColumn('creators', $k)) {
                        continue;
                    }
                    $creator->{$k} = $v;
                }
            }
            $creator->{$request->network . '_last_scrapped_at'} = Carbon::now()->toDateTimeString();
            $creator->save();

            $params = [
                'creator_id' => $creator->id,
                'user_id' => $user->id,
                'team_id' => $user->currentTeam->id,
            ];

            ImportFromSocialAndAddTOCrm::dispatch($data[$request->network . '_handler'], $request->network, $params)->onQueue(
                config('import.'.$request->network.'_queue')
            );

            return response()->json([
                'status' => true,
                'message' => 'Saved to your jovie CRM',
            ], 200);
        } catch (\Throwable $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
                'getLine' => $exception->getLine(),
                'getFile' => $exception->getFile(),
            ], 200);
        }
    }
}
