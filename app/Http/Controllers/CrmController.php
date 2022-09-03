<?php

namespace App\Http\Controllers;

use App\Exports\CrmExport;
use App\Models\Creator;
use App\Models\CreatorComment;
use App\Models\Crm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use MeiliSearch\Client;

class CrmController extends Controller
{
    public function crmCreators(Request $request)
    {
        $creators = Creator::getCrmCreators($request->all());
        $counts = Creator::getCrmCounts();
        return response()->json([
            'status' => true,
            'creators' => $creators,
            'networks' => Creator::NETWORKS,
            'stages' => Crm::stages(),
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
        $creator = Creator::where('id', $id)->with('crmRecordByUser')->has('crmRecordByUser')->first();

        return collect([
            'status' => true,
            'creator' => $creator,
            'networks' => Creator::NETWORKS,
            'stages' => Crm::stages(),
        ]);
    }

    public function updateOverviewCreator(Request $request, $id)
    {
        // update creator
        Creator::updateCrmCreator($request, $id);

        return collect([
            'status' => true,
            'data' => Creator::where('id', $id)->with('crmRecordByUser')->has('crmRecordByUser')->first(),
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
            ->where('user_id', Auth::id())
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
            'message' => 'No more creators.',
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
            'message' => 'No more creators.',
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
}
