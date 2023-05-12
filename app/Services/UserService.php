<?php

namespace App\Services;

use App\Jobs\DefaultCrm;
use App\Models\Contact;
use App\Models\User;
use FontLib\Table\Type\name;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function fetchUserWithPhoneNumber($phone)
    {
        return User::query()->where('phone', $phone)->with('currentTeam')->first();
    }

    public function importContactFromUser($user, $firstName, $lastName)
    {
        $data['user_id'] = $user->id;
        $data['team_id'] = $user->currentTeam->id;
        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;
        $data['override'] = true;
        $data['instagram'] = 'muqeet';
        return Contact::saveContact($data);
    }

    public function registerNewUser($phone, $firstName, $lastName)
    {
        $user = User::query()->create([
            'phone' => $phone,
            'first_name' => $firstName,
            'last_name' => $lastName
        ]);
        event(new Registered($user));
        $teamModel = config('teamwork.team_model');
        $team = $teamModel::create([
            'name' => $firstName,
            'emoji' => '👋',
            'owner_id' => $user->getKey(),
        ]);
        $user->attachTeam($team);

        $team->credits = 10;
        $team->save();
        DefaultCrm::dispatch($user->id, $team->id);
        AttributesService::setAttributes($user, $team, 1);
        return $user->load('currentTeam');
    }
}
