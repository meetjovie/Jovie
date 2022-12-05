<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Creator;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
  

    //getAdminStats returns the number of users and creators in the database
    public function getAdminStats()
    {
        $userCount = User::count();
        $creatorCount = Creator::count();
        return response()->json(['userCount' => $userCount, 'creatorCount' => $creatorCount]);
    }


}
