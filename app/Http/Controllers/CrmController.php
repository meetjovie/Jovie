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
        $creators = Creator::with(['crmRecordByUser'])
            ->has('crmRecordByUser')
            ->when($request->list, function ($q) use ($request) {
                return $q->whereHas('userLists', function ($query) use ($request) {
                    $query->where('user_lists.id', $request->list);
                });
            })
            ->paginate(50);
        return collect([
            'status' => true,
            'creators' => $creators,
            'networks' => Creator::NETWORKS,
            'stages' => Crm::stages()
        ]);
    }
}
