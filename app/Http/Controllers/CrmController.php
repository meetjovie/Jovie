<?php

namespace App\Http\Controllers;

use App\Exports\CrmExport;
use App\Models\Creator;
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
        $dataToUpdateForCrm = [];
        $dataToUpdateForCreator = [];
        foreach ($request->except(['_method', '_token', 'id', 'network']) as $k => $v) {
                if ($k == 'crm_record_by_user') {
                    foreach ($v as $key => $value) {
                        $dataToUpdateForCrm[$key] = $value;
                    }
                } else {
                    $v = $k == 'emails' ? json_encode($v) : $v;
                    $dataToUpdateForCreator[$k] = $v;
                }
        }
        Creator::where('id', $id)->update($dataToUpdateForCreator);

        // update interactions for crm
        Crm::where(['creator_id' => $id, 'user_id' => Auth::id()])->update($dataToUpdateForCrm);

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

    public function a(Request $request)
    {
        $creators = Creator::getCrmCreators($request->all());

        return collect([
            'status' => true,
            'creators' => $creators,
            'networks' => Creator::NETWORKS,
            'stages' => Crm::stages()
        ]);
    }
}
