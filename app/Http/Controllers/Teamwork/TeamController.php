<?php

namespace App\Http\Controllers\Teamwork;

use App\Jobs\DefaultCrm;
use App\Models\FieldAttribute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Mpociot\Teamwork\Exceptions\UserNotInTeamException;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'status' => true,
            'teams' => auth()->user()->teams,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teamwork.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $teamModel = config('teamwork.team_model');

        $team = $teamModel::create([
            'name' => $request->name,
            'emoji' => $request->emoji ?? '👋',
            'owner_id' => $request->user()->getKey(),
        ]);
        $request->user()->attachTeam($team);

        if ($request->user()) {
            $team->credits = 10;
            $team->save();
            DefaultCrm::dispatch($request->user()->id, $team->id);
            foreach (FieldAttribute::DEFAULT_FIELDS as $k => $field) {
                FieldAttribute::query()->updateOrCreate([
                    'field_id' => $field['id'],
                    'user_id' => $request->user()->id,
                    'team_id' => $team->id,
                ], [
                    'type' => 'default',
                    'order' => $k
                ]);
            }
            $basicPlan = json_decode(json_encode(config('services.stripe.basic_plan')));
            $subscription = $team->subscribeTeam(null, null, $basicPlan->product, $basicPlan->plan);

            if (!$subscription) {
                return response([
                    'status' => false,
                    'message' => 'Something went wrong.'
                ]);
            }
        }
        return response([
            'status' => true,
            'team' => $team,
            'user' => User::currentLoggedInUser()
        ]);
    }

    /**
     * Switch to the given team.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function switchTeam($id)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($id);
        try {
            auth()->user()->switchTeam($team);
        } catch (UserNotInTeamException $e) {
            return response([
                'status' => false,
            ], 403);
        }

        return response([
            'status' => true,
            'team' => $team,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::findOrFail($id);

        if (! auth()->user()->isOwnerOfTeam($team)) {
            return response([
                'status' => false,
            ], 403);
        }

        return response([
            'status' => true,
            'team' => $team,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $teamModel = config('teamwork.team_model');

        $team = $teamModel::findOrFail($id);
        $team->name = $request->name;
        $team->save();

        return response([
            'status' => true,
            'team' => $team,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teamModel = config('teamwork.team_model');

        $team = $teamModel::findOrFail($id);
        if (! auth()->user()->isOwnerOfTeam($team)) {
            return response([
                'status' => false,
            ], 403);
        }

        $team->delete();

        $userModel = config('teamwork.user_model');
        $userModel::where('current_team_id', $id)
                    ->update(['current_team_id' => null]);

        return response([
            'status' => true,
            'team' => $team,
        ]);
    }
}
