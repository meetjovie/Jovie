<?php

namespace App\Http\Controllers;

use App\Models\UserList;
use App\Repositories\CustomAuth0UserRepository;
use Illuminate\Http\Request;
use function collect;

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
