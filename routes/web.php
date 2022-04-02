<?php

use Illuminate\Support\Facades\Route;
use MeiliSearch\Client;

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
Route::get('config-mili', function () {
    return config('scout.meilisearch');
});
Route::get('/filters-scout', function () {
    $client = new Client(config('scout.meilisearch.host'));
    $response = $client->index('creators')->updateFilterableAttributes([
        'instagram_followers',
        'instagram_engagement_rate',
        'engaged_follows',
        'gender',
        'city',
        'country',
        'instagram_category',
        'emails',
        'has_emails',
        'tags'
    ]);
    $response = $client->index('creators')->getFilterableAttributes();
    $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
//    dd($client);
    $response = $client->getAllIndexes();
//    $response = $client->index('creators')->updateFilterableAttributes(['instagram_followers']);
    dd($response);
});
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

Route::get('{any?}', function () {
    return view('welcome');
});

