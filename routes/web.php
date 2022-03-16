<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('creator', function () {
    $url = ('https://www.instagram.com/timwhite/?__a=1&hl=en');
    $client = new \GuzzleHttp\Client();
    $response = $client->get('https://api.webscraping.ai/html', array(
        'query' => [
            'api_key' => config('import.scrapper_api_key'),
            'url' => $url,
            'proxy' => 'residential',
            'timeout' => 30000
        ]
    ));
    dd(json_decode($response->getBody()->getContents()));
    return json_decode($response->getBody()->getContents());
    $creator = \App\Models\Creator::first();
    $creator->instagram_handler = 'https://wwadinstagram.com/timwhite';
    $creator->tiktok_handler = 'https://www.tiktok.com/@timwhite';
    $creator->onlyFans_handler = 'https://www.onlyfans.com/username';
    $creator->linkedin_handler = 'https://linkedin.com/in/username';
    $creator->twitter_handler = 'BettieBallhaus';
    $creator->snapchat_handler = 'https://www.snapchat.com/add/usernamesnp-chat';
    $creator->twitch_handler = 'asdtwitch.com/usernamet';
    $creator->youtube_handler = 'asdtwitch.com/usernamet';
    dd($creator);
});

Route::post('/waitlist', [\App\Http\Controllers\UserController::class, 'addToWaitList']);
Route::get('/public-profiles', [\App\Http\Controllers\UserController::class, 'publicProfile']);

//Route::get('creator', function () {
//    $creator = \App\Models\Creator::first();
//    dd($creator->instagram_media);
//});


/**
 * Teamwork routes
 */
Route::group(['prefix' => 'teams', 'namespace' => 'Teamwork'], function()
{
    Route::get('/', [App\Http\Controllers\Teamwork\TeamController::class, 'index'])->name('teams.index');
    Route::get('create', [App\Http\Controllers\Teamwork\TeamController::class, 'create'])->name('teams.create');
    Route::post('teams', [App\Http\Controllers\Teamwork\TeamController::class, 'store'])->name('teams.store');
    Route::get('edit/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'edit'])->name('teams.edit');
    Route::put('edit/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'update'])->name('teams.update');
    Route::delete('destroy/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'destroy'])->name('teams.destroy');
    Route::get('switch/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'switchTeam'])->name('teams.switch');

    Route::get('members/{id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'show'])->name('teams.members.show');
    Route::get('members/resend/{invite_id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'resendInvite'])->name('teams.members.resend_invite');
    Route::post('members/{id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'invite'])->name('teams.members.invite');
    Route::delete('members/{id}/{user_id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'destroy'])->name('teams.members.destroy');

    Route::get('accept/{token}', [App\Http\Controllers\Teamwork\AuthController::class, 'acceptInvite'])->name('teams.accept_invite');
});

Route::get('{any?}', function () {
    return view('welcome');
});
