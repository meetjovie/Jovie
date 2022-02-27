<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Models\Crm;
use App\Repositories\CustomAuth0UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'emails' => json_encode($request->emails)
        ];
        Creator::where('id', $id)->update($data);

        // update interactions for crm
        $data = [
            'favourite' => $request->favourite,
        ];
        if (isset($request->instagram_rating)) {
            $data['instagram_rating'] = $request->instagram_rating;
        }
        Crm::where(['creator_id' => $id, 'user_id' => Auth::id()])->update($data);

        return collect([
            'status' => true,
            'data' => $data,
        ]);
    }
}
