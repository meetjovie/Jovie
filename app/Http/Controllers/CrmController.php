<?php

namespace App\Http\Controllers;

use App\Repositories\CustomAuth0UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrmController extends Controller
{
    public function crmCreators(Request $request)
    {
        $creators = DB::table('creators')
            ->join('crms', function ($join) use ($request) {
                $join->on('crms.creator_id', '=', 'creators.id');
                $join->where('crms.user_id', CustomAuth0UserRepository::currentUser($request)->id);
            })->select(
                'creators.*',
                'crms.user_id as crm_user_id',
                'crms.id as crm_id',
                'crms.offer',
                'crms.stage',
                'crms.last_contacted',
                'crms.muted'
            )->get();

        return collect([
            'status' => true,
            'creators' => $creators
        ]);
    }
}
