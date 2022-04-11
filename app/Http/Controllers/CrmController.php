<?php

namespace App\Http\Controllers;

use App\Exports\CrmExport;
use App\Models\Creator;
use App\Models\CreatorComment;
use App\Models\Crm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class CrmController extends Controller
{
    public function crmCreators(Request $request)
    {
        $creators = Creator::getCrmCreators($request->all());

        return collect([
            'status' => true,
            'creators' => $creators,
            'networks' => Creator::NETWORKS,
            'stages' => Crm::stages()
        ]);
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
            'stages' => Crm::stages()
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
            'creator_id' => 'required'
        ]);
        $creator = Creator::where('id', $request->creator_id)->count();
        if ($creator) {
            $comment = CreatorComment::create([
                'user_id' => Auth::id(),
                'creator_id' => $request->creator_id,
                'comment' => $request->comment
            ]);
            return response([
                'status' => true,
                'message' => 'Comment added.',
                'data' => $comment->load('user')
            ]);
        }
        return response([
            'status' => false,
            'message' => 'Creator does not exist.'
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
            'comments' => $comments
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
                    'data' => $creator
                ]);
            }
        }
        return response([
            'status' => false,
            'data' => null,
            'message' => 'No more creators.'
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
                    'data' => $creator
                ]);
            }
        }
        return response([
            'status' => false,
            'data' => null,
            'message' => 'No more creators.'
        ]);
    }

    public function addCreatorToCreator(Request $request)
    {
        $request->validate([
            'creator_id' => 'required'
        ]);

        $crm = Crm::updateOrCreate(['user_id' => Auth::id(),'creator_id' => $request->creator_id],
            ['user_id' => Auth::id(),'creator_id' => $request->creator_id]
        );

        return response([
            'status' => true,
            'message' => 'Added to contacts.',
            'crm' => $crm
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

        if (!empty($request->gender)) {
            $creators = $creators->where('gender', $request->gender);
        }
        if (!empty($request->instagram_category)) {
            $creators = $creators->where('instagram_category', $request->instagram_category);
        }
        if (!empty($request->city)) {
            $creators = $creators->where('city', $request->city);
        }
        if (!empty($request->country)) {
            $creators = $creators->where('country', $request->country);
        }
        $creators = $creators->take(PHP_INT_MAX)->paginateRaw($page);

        $request->instagram_engagement_rate = json_decode($request->instagram_engagement_rate);

        if (!$crms) {
            $crms = \App\Models\Crm::search("")
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

            $matched = true;
            if ($request->instagram_engagement_rate) {
                if (!empty($request->instagram_engagement_rate[0])) {
                    $matched = $creator['instagram_engagement_rate'] >= $request->instagram_engagement_rate[0] / 100
                        && $creator['instagram_engagement_rate'] <= $request->instagram_engagement_rate[1] / 100;
                } else {
                    $matched = false;
                }
            }
            if ($matched) {
                $hits[] = $tempCreator;
            }
        }

        $creators['hits'] = $hits;
        return $creators;
    }
}
