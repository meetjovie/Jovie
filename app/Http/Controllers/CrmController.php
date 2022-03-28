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


    public function updateCreatorStage(Request $request)
    {
        $user_id = Crm::where('id', $request->crm_id)->first();
        Crm::where('id' ,$request->crm_id)->update([
            'stage' => $request->stage,
            'pipeline_index' => $request->newIndex
        ]);

        if ($request->newIndex) {
            for ($i = 0; $i < $request->newIndex; $i++) {
                Crm::where('user_id' , $user_id)->orderBy('pipeline_index', 'asc')->update([
                    'stage' => $request->stage,
                    'pipeline_index' => $request->newIndex
                ]);
            }
            Crm::where('id' ,$request->crm_id)->update([
                'stage' => $request->stage,
                'pipeline_index' => $request->newIndex
            ]);
        } else {
            Crm::where('user_id' ,$user_id)->where('pipeline_index', 0)->update([
                'pipeline_index' => 1
            ]);
            Crm::where('id' ,$request->crm_id)->update([
                'pipeline_index' => 0
            ]);

        }

        return collect([
            'status' => true,
        ]);
    }

    public function updateCreatorIndex(Request $request)
    {
        $user_id = Crm::where('id', $request->crm_id)->first();

        if ($request->newIndex) {
            for ($i = 0; $i < $request->newIndex; $i++) {
                Crm::where('user_id' , $user_id)->where('stage')->orderBy('pipeline_index', 'asc')->update([
                    'stage' => $request->stage,
                    'pipeline_index' => $request->newIndex
                ]);
            }
            Crm::where('id' ,$request->crm_id)->update([
                'stage' => $request->stage,
                'pipeline_index' => $request->newIndex
            ]);
        } else {
            Crm::where('user_id' ,$user_id)->where('pipeline_index', 0)->update([
                'pipeline_index' => 1
            ]);
            Crm::where('id' ,$request->crm_id)->update([
                'pipeline_index' => 0
            ]);

        }

        return collect([
            'status' => true,
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
}
