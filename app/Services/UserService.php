<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\User;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function fetchUserWithPhoneNumber($phone)
    {
        return User::query()->where('phone', $phone)->with('currentTeam')->first();
    }

    public function importContactFromUser($user, $fullName)
    {
        $name = explode(' ', $fullName);
        $data['user_id'] = $user->id;
        $data['team_id'] = $user->currentTeam->id;
        $data['first_name'] = $name[0];
        $data['last_name'] = $name[1] ?? null;
        $data['override'] = true;
        $data['instagram'] = 'muqeet';
        return Contact::saveContact($data);
    }
}
