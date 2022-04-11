<?php

use Illuminate\Http\Request;
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
Route::get('/search-mili', [\App\Http\Controllers\CrmController::class, 'discovery']);
Route::get('/search-miali', function (Request $request) {

    $creators = \App\Models\Creator::search($request->q);

    if (!empty($request->gender)) {
        $creators = $creators->where('gender', $request->gender);
    }
    if (!empty($request->instagram_category)) {
        $creators = $creators->where('instagram_category', $request->instagram_category);
    }
    if (!empty($request->city)) {
        $creators = $creators->where('city', $request->city);
    }
    if (!empty($request->country)) {
        $creators = $creators->where('country', $request->country);
    }
    $creators = $creators->take(PHP_INT_MAX)->paginateRaw($request->page);

    $request->instagram_engagement_rate = json_decode($request->instagram_engagement_rate);

    $crms = \App\Models\Crm::search("")
        ->where('user_id', 1)
        ->where('selected', $request->selected)
        ->where('rejected', $request->rejected)
        ->take(PHP_INT_MAX)
        ->raw();
    $crms = collect($crms['hits']);
    $crmCreatorIds = $crms->pluck('creator_id')->toArray();

    $hits = [];
    foreach ($creators['hits'] as &$creator) {
        if (in_array($creator['id'], $crmCreatorIds)) {
            $crm = $crms->where('creator_id', $creator['id'])->first();
            $muted = $crm['muted'];
            if ($muted) {
                continue;
            } else {
                $creator['crm'] = $crm;
            }
        }

        $matched = true;
        if ($request->instagram_engagement_rate) {
            if (!empty($request->instagram_engagement_rate[0])) {
                $matched = $creator['instagram_engagement_rate'] >= $request->instagram_engagement_rate[0] / 100
                    && $creator['instagram_engagement_rate'] <= $request->instagram_engagement_rate[1] / 100;
            } else {
                $matched = false;
            }
        }
        if ($matched) {
            $hits[] = $creator;
        }
    }

    $creators['hits'] = $hits;
    return $creators;
});
Route::get('config-mili', function () {
    return config('scout.meilisearch');
});
Route::get('index-mili', function () {
    $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
    return $client->getAllIndexes();
});
Route::get('/filters-scout', function () {
    $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
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
    dump($response);
    $response = $client->index('crms')->updateFilterableAttributes([
        'creator_id',
        'user_id',
        'selected',
        'rejected',
        'muted',
        'favourite',
        'stage',
        'rating',
    ]);
    $response = $client->index('crms')->getFilterableAttributes();
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

