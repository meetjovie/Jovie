<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\UserList;
use App\Repositories\CustomAuth0UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserListsController extends Controller
{
    public function getLists(Request $request)
    {
        $lists = UserList::where('user_id', CustomAuth0UserRepository::currentUser($request)->id)->get();
        return collect([
            'status' => true,
            'lists' => $lists
        ]);
    }
}
