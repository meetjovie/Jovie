<?php

namespace App\Http\Controllers;

use App\Models\UserList;
use function collect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserListsController extends Controller
{
    public function getLists(Request $request)
    {
        $lists = UserList::getLists(Auth::id());
        return collect([
            'status' => true,
            'lists' => $lists,
        ]);
    }
}
