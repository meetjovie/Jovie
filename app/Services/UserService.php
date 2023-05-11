<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\User;
use FontLib\Table\Type\name;

class UserService
{
    public function fetchUserWithPhoneNumber($phone)
    {
        return User::query()->where('phone', $phone)->with('currentTeam')->first();
    }

    public function importContactFromUser($user, $fullName)
    {
        $name = explode($fullName, ' ');
        $data['user_id'] = $user->id;
        $data['team_id'] = $user->currentTeam->id;
        $data['first_name'] = $name[0];
        $data['last_name'] = $name[1];
        return Contact::saveContact($data)->first();
    }
}