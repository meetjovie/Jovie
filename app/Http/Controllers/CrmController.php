<?php

namespace App\Http\Controllers;

use App\Exports\CrmExport;
use App\Models\Creator;
use App\Models\CreatorComment;
use App\Models\Crm;
use App\Models\User;
use App\Models\UserList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use MeiliSearch\Client;

class CrmController extends Controller
{
    public function crmCreators(Request $request)
    {
        try {
            $creators = Creator::getCrmCreators($request->all());
            $counts = Creator::getCrmCounts();
            return response()->json([
                'status' => true,
                'creators' => $creators,
                'networks' => Creator::NETWORKS,
                'stages' => Crm::stages(),
                'counts' => $counts
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => ($e->getMessage().' '.$e->getFile().' '.$e->getLine())
            ], 200);
        }
    }

    public function getExtensionCreator(Request $request)
    {
        try {
            $creator = Creator::getCrmCreatorByHandler($request->all());
            if ($creator) {
                return response()->json([
                    'status' => true,
                    'creator' => $creator,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => ($e->getMessage().' '.$e->getFile().' '.$e->getLine())
            ], 200);
        }
    }

    public function crmCounts()
    {
        $counts = Creator::getCrmCounts();
        return response()->json([
            'status' => true,
            'counts' => $counts
        ], 200);
    }

    public function updateCrmCreator(Request $request, $id)
    {
        // update creator
        Creator::updateCrmCreator($request, $id);

        return collect([
            'status' => true,
            'data' => Creator::getCrmCreators(['id' => $id])->first(),
        ]);
    }

    public function moveCreator(Request $request, $creatorId)
    {
        $data = $request->validate([
            'selected' => 'required|numeric',
            'rejected' => 'required|numeric',
        ]);
        $user = User::with('currentTeam')->where('id', Auth::id())->first();
        $data['team_id'] = $user->currentTeam->id;
        $crm = Crm::updateOrCreate(['creator_id' => $creatorId, 'user_id' => $user->id, 'team_id' => $user->currentTeam->id], $data);
        Creator::where('id', $creatorId)->searchable();

        return response([
            'status' => true,
            'data' => $crm,
            'message' => 'Creator moved.',
        ]);
    }

    public function exportCrm(Request $request)
    {
        $params = $request->all();
        $params['export'] = true;
        $creators = Creator::getCrmCreators($params);

        return Excel::download(new CrmExport($creators), 'creators.csv');
    }

    public function overview($id)
    {
        $creator = Creator::getCrmCreators(['crm_id' => $id])->first();

        if ($creator) {
            return collect([
                'status' => true,
                'creator' => $creator,
                'networks' => Creator::NETWORKS,
                'stages' => Crm::stages(),
            ]);
        }
        return collect([
            'status' => false,
        ]);
    }

    public function updateOverviewCreator(Request $request, $id)
    {
        // update creator
        $data = Creator::updateCrmCreator($request, $id);
        $creator = Creator::getCrmCreators(['crm_id' => $data['crm']->id])->first();
        return collect([
            'status' => true,
            'data' => $creator,
        ]);
    }

    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'creator_id' => 'required',
        ]);
        $creator = Creator::where('id', $request->creator_id)->count();
        if ($creator) {
            $comment = CreatorComment::create([
                'user_id' => Auth::id(),
                'team_id' => Auth::user()->currentTeam->id,
                'creator_id' => $request->creator_id,
                'comment' => $request->comment,
            ]);

            return response([
                'status' => true,
                'message' => 'Comment added.',
                'data' => $comment->load('user'),
            ]);
        }

        return response([
            'status' => false,
            'message' => 'Creator does not exist.',
        ]);
    }

    public function getComments(Request $request, $creatorId)
    {
        $comments = CreatorComment::with('user')
            ->where('creator_id', $creatorId)
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

    public function nextCreator($id)
    {
        $crm = Crm::where('id', '<', $id)->where('user_id', Auth::id())->orderByDesc('id')->first();
        if ($crm) {
            $creator = Creator::with('crmRecordByUser')->whereHas('crmRecordByUser', function ($q) use ($crm) {
                $q->where('id', $crm->id);
            })->first();
            if ($creator) {
                return response([
                    'status' => true,
                    'data' => $creator,
                ]);
            }
        }

        return response([
            'status' => false,
            'data' => null,
            'message' => 'No more contacts.',
        ]);
    }

    public function previousCreator($id)
    {
        $crm = Crm::where('id', '>', $id)->where('user_id', Auth::id())->first();
        if ($crm) {
            $creator = Creator::with('crmRecordByUser')->whereHas('crmRecordByUser', function ($q) use ($crm) {
                $q->where('id', $crm->id);
            })->first();
            if ($creator) {
                return response([
                    'status' => true,
                    'data' => $creator,
                ]);
            }
        }

        return response([
            'status' => false,
            'data' => null,
            'message' => 'No more contacts.',
        ]);
    }

    public function addCreatorToCreator(Request $request)
    {
        $request->validate([
            'creator_id' => 'required',
        ]);

        $user = User::with('currentTeam')->where('id', Auth::id())->first();
        $crm = Crm::updateOrCreate(['user_id' => $user->id, 'team_id' => $user->currentTeam->id, 'creator_id' => $request->creator_id],
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

        $filtersString = '(mutedRecord!=user_'.Auth::id().' OR mutedRecordCount = 0)';

        $filtersString .= ' AND (selectedRecord!=user_'.Auth::id().' OR selectedRecordCount=0)';
        $filtersString .= ' AND (rejectedRecord!=user_'.Auth::id().' OR rejectedRecordCount=0)';
//        dd($filtersString);
        if (! empty($request->gender)) {
            $filtersString = $filtersString.' AND gender='.$request->gender;
        }
        if (! empty($request->instagram_category)) {
            $filtersString = $filtersString.' AND instagram_category='.$request->instagram_category;
        }
        if (! empty($request->city)) {
            $filtersString = $filtersString.' AND city='.$request->city;
        }
        if (! empty($request->country)) {
            $filtersString = $filtersString.' AND country='.$request->country;
        }

        $request->instagram_engagement_rate = json_decode($request->instagram_engagement_rate);
        if ($request->instagram_engagement_rate) {
            if (! empty($request->instagram_engagement_rate[0])) {
                $filtersString = $filtersString.' AND instagram_engagement_rate>='.($request->instagram_engagement_rate[0] / 100);
            }
            if (! empty($request->instagram_engagement_rate[1])) {
                $filtersString = $filtersString.' AND instagram_engagement_rate<='.($request->instagram_engagement_rate[1] / 100);
            }
        }
        $request->instagram_followers = json_decode($request->instagram_followers);
        if ($request->instagram_followers) {
            if (! empty($request->instagram_followers[0])) {
                $filtersString = $filtersString.' AND instagram_followers>='.$request->instagram_followers[0];
            }
            if (! empty($request->instagram_followers[1])) {
                $filtersString = $filtersString.' AND instagram_followers<='.$request->instagram_followers[1];
            }
        }

        if (! empty($request->emails)) {
            $filtersString = $filtersString.' AND emails='.$request->emails;
        }

        //dd($filtersString);
        dd($client->index('creators')->getSearchableAttributes());
        $data = $client->index('creators')->search($request->q, [
            'filter' => $filtersString,
            'offset' => $request->page,
            'limit' => 30,
        ])->getRaw();
        dd($data);

        if (! $crms) {
            $crms = $client->index('crms')->search('', [
                'filter' => ('selected='.$request->selected.' AND rejected='.$request->rejected),
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

    public function toggleCreatorsFromList(Request $request)
    {
        $user = User::with('currentTeam')->where('id', Auth::id())->first();
        $list = UserList::where('id', $request->list)->where('team_id', $user->currentTeam->id)->first();
        if (!$list) {
            throw ValidationException::withMessages([
                'list' => ['List does not exists']
            ]);
        }
        $request->validate([
            'creator_ids' => 'required'
        ]);
        $creatorIds = is_array($request->creator_ids) ? $request->creator_ids : [$request->creator_ids];
        if ($request->remove) {
            DB::table('creator_user_list')->whereIn('creator_id', $creatorIds)->where('user_list_id', $list->id)->delete();
        } else {
            $list->creators()->syncWithoutDetaching($creatorIds);
        }
        return response()->json([
            'status' => true,
            'list' => [
                'id' => $list->id,
                'name' => $list->name,
                'emoji' => $list->emoji,
            ],

            'message' => ('Contacts '. ($request->remove == true ? 'removed from list' : 'added to list'))

        ], 200);
    }

    public function toggleArchiveCreators(Request $request)
    {
        $request->validate([
            'creator_ids' => 'required'
        ]);
        $creatorIds = is_array($request->creator_ids) ? $request->creator_ids : [$request->creator_ids];
        $user = User::with('currentTeam')->where('id', Auth::id())->first();
        Crm::whereIn('creator_id', $creatorIds)->where('team_id', $user->currentTeam->id)->update(['archived' => boolval($request->archived)]);
        return response()->json([
            'status' => true,
            'message' => ('Creators '.boolval($request->archived) ? 'archived.' : 'unarchived.')
        ], 200);
    }

    public function updateCrmMeta(Request $request, $id)
    {
        $data = $request->validate([
            'meta' => 'required'
        ]);
        $user = User::with('currentTeam')->where('id', Auth::id())->first();
        $crm = Crm::where('id', $id)->first();
        if (!$crm) {
            return response()->json([
                'status' => false,
                'message' => 'Crm not found.',
                'data' => null
            ], 200);
        }
        $meta = $crm->meta;
        foreach ($data['meta'] as $k => $v) {
            if (is_array($meta)) {
                $meta[$k] = $v;
            } else {
                $meta->{$k} = $v;
            }
        }
        $data['meta'] = $meta;
        if (isset($data['meta']->emails)) {
            $emails = $data['meta']->emails;
            $data['meta']->emails = is_array($emails) ? $emails : explode(',', $emails);
        }

        if (isset($data['meta']->name)) {
            $nameSplits = explode(' ', $data['meta']->name);
            foreach ($nameSplits as $k => $split) {
                if ($k == 0) {
                    $data['meta']->first_name = $split;
                } else {
                    if ($k == 1) $data['meta']->last_name = null;
                    $data['meta']->last_name .= ' '.$split;
                }
            }
        }
        $crm->meta = $data['meta'];
        $crm->save();
//        $crm = Crm::updateOrCreate(['creator_id' => $crm->creator_id, 'user_id' => $user->id, 'team_id' => $user->currentTeam->id], array_merge(['creator_id' => $crm->creator_id, 'user_id' => $user->id, 'team_id' => $user->currentTeam->id], $data));
        return response()->json([
            'status' => true,
            'message' => 'Data updated.',
            'data' => Creator::getCrmCreators(['id' => $crm->creator_id])->first()
        ], 200);
    }

    public function saveToCrm(Request $request)
    {
        try {
            $user = User::currentLoggedInUser();

            $data = $request->except('network');
            $data = array_filter($data);
            $creator = Creator::query()->where(($request->network.'_handler'), $request->{$request->network.'_handler'})->first();
            $creator = $creator ?? new Creator();
            if (!empty($data['profile_pic_url']) && $request->network ==  'instagram') {
                $profilePicUrl = $data['profile_pic_url'];
                unset($data['profile_pic_url']);
                $fileName = explode('/tmp/', $profilePicUrl)[1] ?? null;
                if ($fileName) {
                    Storage::disk('s3')->copy(
                        ('tmp/'.$fileName),
                        (Creator::CREATORS_CSV_PATH.$fileName)
                    );
                    $data['profile_pic_url'] = Storage::disk('s3')->url(Creator::CREATORS_CSV_PATH.$fileName);
                }
            }
            $meta = $creator->{$request->network.'_meta'};
            if (isset($data['profile_pic_url'])) {
                $meta->profile_pic_url = $data['profile_pic_url'];
            }
            $creator->{$request->network.'_meta'} = $meta;

            unset($data['profile_pic_url']);
            foreach ($data as $k => $v) {
                if ($k == 'meta') {
                    foreach ($v as $kk => $vv) {
                        if (! Schema::hasColumn('creators', $kk)) continue;
                        $creator->{$kk} = $vv;
                    }
                } else {
                    if (! Schema::hasColumn('creators', $k)) continue;
                    $creator->{$k} = $v;
                }
            }
            $creator->{$request->network.'_last_scrapped_at'} = Carbon::now()->toDateTimeString();
            $creator->save();
            Creator::addToListAndCrm($creator, null, $user->id, $user->currentTeam->id);

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
