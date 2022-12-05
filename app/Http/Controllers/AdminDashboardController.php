<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Creator;
use GuzzleHttp\Client;


use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
  

    //getAdminStats returns the number of users and creators in the database
    public function getAdminStats()
    {
        $userCount = User::count();
        $creatorCount = Creator::count();
        //count the number of users that have been created in the last 24 hours
        $userCount24 = User::where('created_at', '>=', now()->subDay())->count();
        //count the number of users that have been created in the last 7 days
        $userCount7 = User::where('created_at', '>=', now()->subDays(7))->count();
        //count the number of users that have been created in the last 30 days
        $userCount30 = User::where('created_at', '>=', now()->subDays(30))->count();
        return response()->json([
            'userCount' => $userCount,
            'creatorCount' => $creatorCount,
            'userCount24' => $userCount24,
            'userCount7' => $userCount7,
            'userCount30' => $userCount30,
        ]);
    }

  

    public function getAccountBalance()
    {
        // Create a new Guzzle client instance
        $client = new Client();

        try {
            // Make the request to the https://api.mercury.com/api/v1/accounts endpoint
            $response = $client->request('GET', 'https://api.mercury.com/api/v1/accounts', [
                'auth' => [
                    env('MERCURY_API_KEY'),
                    ''
                ],
                'withCredentials' => true,
                'followRedirect' => true,
                'maxRedirects' => 10,
            ]);

            // Get the accounts data from the response
            $accounts = json_decode($response->getBody()->getContents())->accounts;

            // Sum the currentBalance property of each account to get the total account balance
            $cashBalance = array_reduce($accounts, function ($total, $account) {
                return $total + $account->currentBalance;
            }, 0);

            // Return the total account balance
            return response()->json([
                'cashBalance' => $cashBalance,
            ]);

        } catch (\Exception $e) {
            // Log the error message
            Log::error($e->getMessage());

            // Return a failure response
            return response()->json([
                'success' => false,
                'message' => 'There was an error getting the account balance'
            ], 500);
        }
    }

    

    //write a function that returns the account balances of all account on mercury



}
