<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
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

Route::get('/scrap', function () {
    try {
        $url = "https://www.tiktok.com/@love_mian_jaan";
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://api.webscraping.ai/html', [
            'query' => [
                'api_key' => config('import.scrapper_api_key'),
                'js' => false,
                'url' => $url,
                'proxy' => 'residential',
                'timeout' => 10000,
            ],
        ]);
dd($response->getBody()->getContents());
        return $response;
    } catch (\Exception $e) {
        dd($e->getMessage());
        return $e->getResponse();
    }
    $username = "@love_mian_jaan";
    $url = "https://www.tiktok.com/@boyjamping/video/7173243579559677210?is_from_webapp=v1&item_id=7173243579559677210";
    $client = new \Goutte\Client(); // create a crawler object from this link
    $crawler = $client->request('GET', $url);

    $caption = '';
    $handler = $crawler->filterXPath('//div[contains(@data-e2e,"browse-video-desc")]')->children()->each(function ($node) use (&$caption) {
        $text = $node->extract(['_text'])[0];
        if (! str_contains($text, '.tiktok')) {
            $caption .= $text;
        }
    });
    dd($caption);
    $handler = $crawler->filterXPath('//h2[contains(@data-e2e,"user-title")]')->first()->getNode(0)->firstChild->data;
    $name = @$crawler->filterXPath('//h1[contains(@data-e2e,"user-subtitle")]')->first()->getNode(0)->firstChild->data;
    $followers = @$crawler->filterXPath('//strong[contains(@data-e2e,"followers-count")]')->first()->getNode(0)->firstChild->data;
    $likes = @$crawler->filterXPath('//strong[contains(@data-e2e,"likes-count")]')->first()->getNode(0)->firstChild->data;
    $biography = @$crawler->filterXPath('//h2[contains(@data-e2e,"user-bio")]')->first()->getNode(0)->firstChild->data;
    $website = @$crawler->filterXPath('//a[contains(@data-e2e,"user-link")]')->first()->getNode(0)->lastChild->firstChild->data;
    $profilePicUrl = @$crawler->filterXPath('//div[contains(@data-e2e,"user-avatar")]/span[@shape="circle"]/img[@loading="lazy"]')->first()->extract(['src'])[0];
    $post1 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[1]/div/div/div/a/div/div/img')->first()->extract(['src'])[0];
    $title1 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[1]/div/div/div/a/div/div/img')->first()->extract(['src'])[0];
    $url1 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[1]/div/div/div/a')->first()->extract(['href'])[0];
    $post2 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[2]/div/div/div/a/div/div/img')->first()->extract(['src'])[0];
    $title2 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[2]/div/div/div/a/div/div/img')->first()->extract(['alt'])[0];
    $url2 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[2]/div/div/div/a')->first()->extract(['href'])[0];
    $post3 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[3]/div/div/div/a/div/div/img')->first()->extract(['src'])[0];
    $title3 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[3]/div/div/div/a/div/div/img')->first()->extract(['alt'])[0];
    $url3 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[3]/div/div/div/a')->first()->extract(['href'])[0];

    $timelineMedia = [
        [
            'thumbnail' => $post1,
            'url' => $url1,
            'title' => $title1
        ],
        [
            'thumbnail' => $post2,
            'url' => $url2,
            'title' => $title2
        ],
        [
            'thumbnail' => $post3,
            'url' => $url3,
            'title' => $title3
        ],
    ];
//    if ($followers >= 10000) {
        foreach ($timelineMedia as &$media) {
            if (isset($media['url'])) {
                $url = $media['url'];
                $client = new \Goutte\Client(); // create a crawler object from this link
                $crawler = $client->request('GET', $url);
                $media['likes'] = @$crawler->filterXPath('//strong[contains(@data-e2e,"like-count")]')->first()->getNode(0)->firstChild->data;
                $media['shares'] = @$crawler->filterXPath('//strong[contains(@data-e2e,"share-count")]')->first()->getNode(0)->firstChild->data;
                $media['comments'] = @$crawler->filterXPath('//strong[contains(@data-e2e,"comment-count")]')->first()->getNode(0)->firstChild->data;
                $media['post_date'] = @$crawler->filterXPath('//span[contains(@data-e2e,"browser-nickname")]/span[3]')->first()->getNode(0)->firstChild->data;
            }
        }
//    }

    $user = (object) [];
    $user->username = $username;
    $user->name = $name;
    $user->followers = $followers;
    $user->likes = $likes;
    $user->biography = $biography;
    $user->email = self::getEmailFromString($biography);
    $user->website = $website;
    $user->profile_pic_url = $profilePicUrl;
    $user->timeline_media = $timelineMedia;
    dd($user);
    return $user;
    dd($email);
    $links = collect();
    $crawler->filter('a.sc-pFZIQ')->each(function ($node) use ($links) {
        $href = $node->extract(['href'])[0];
        $links->push($href);
    });
    $crawler->filter('a.sc-eCssSg')->each(function ($node) use ($links) {
        $href = $node->extract(['href'])[0];
        if ($href != 'https://linktr.ee/') {
            $links->push($href);
        }
    });

    return $links->toArray();
});
Route::get('check', function () {
    $value = 'http://twitch.com/redbull';
    $twitch = null;
    // Regex for verifying a twitch URL
    $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitch\.tv|twitch\.com)\/([A-Za-z0-9-_\.]+)/';

    // Verify valid twitch URL
    if (preg_match($regex, $value, $matches)) {
        $twitch = $matches[1];
        dump(1);
        dd($twitch);

        return;
    }
    $regexUrl = '/(?:(?:http|https):\/\/)/';
    // Verify valid Instagram URL
    if (preg_match($regexUrl, $value, $matches)) {
        $twitch = null;
        dump(2);
        dd($twitch);

        return;
    }
    dump(3);
    dd(empty($value) ? null : $value);
    $this->attributes['twitch'] = empty($value) ? null : $value;
});
Route::get('/search-mili', [\App\Http\Controllers\CrmController::class, 'discovery']);
Route::get('/search-miali', function (Request $request) {
    $creators = \App\Models\Creator::search($request->q);

    if (! empty($request->gender)) {
        $creators = $creators->where('gender', $request->gender);
    }
    if (! empty($request->instagram_category)) {
        $creators = $creators->where('instagram_category', $request->instagram_category);
    }
    if (! empty($request->city)) {
        $creators = $creators->where('city', $request->city);
    }
    if (! empty($request->country)) {
        $creators = $creators->where('country', $request->country);
    }
    $creators = $creators->take(PHP_INT_MAX)->paginateRaw($request->page);

    $request->instagram_engagement_rate = json_decode($request->instagram_engagement_rate);

    $crms = \App\Models\Crm::search('')
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
            if (! empty($request->instagram_engagement_rate[0])) {
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
    Route::get('config-queue', function () {
        return config('queue');
    });
Route::get('index-mili', function () {
    $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));

    return $client->getAllIndexes();
});
Route::get('available-filters', function () {
    $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
    $response = $client->index('creators')->getFilterableAttributes();
    dd($response);
});
Route::get('meili-tasks', function (Request $request) {
    $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
    try {
        $index = $client->getIndex('creators');
        if ($request->id) {
            $response = $client->index('creators')->getTask($request->id);
        } else {
            $response = $client->index('creators')->getTasks();
        }

        return $response;
    } catch (Exception $e) {
        $response = $client->getTasks();
        $data[0] = $e->getMessage().' Showing all tasks.';
        $data[1] = $response;

        return $data;
    }
});
Route::get('/filters-scout', function () {
    $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
    $response = $client->index('creators')->updateFilterableAttributes([
        'id',
        'instagram_followers',
        'instagram_engagement_rate',
        'engaged_follows',
        'gender',
        'city',
        'country',
        'instagram_category',
        'emails',
        'has_emails',
        'tags',
        'all_to',
        'selected_to',
        'rejected_to',
        'unique',
    ]);
    $response = $client->index('creators')->getFilterableAttributes();
    dd($response);
});
Route::get('creator', function () {
    $url = ('https://www.instagram.com/timwhite/?__a=1&hl=en');
    $client = new \GuzzleHttp\Client();
    $response = $client->get('https://api.webscraping.ai/html', [
        'query' => [
            'api_key' => config('import.scrapper_api_key'),
            'url' => $url,
            'proxy' => 'residential',
            'timeout' => 30000,
        ],
    ]);
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
//    $creator = \App\Models\Contact::first();
//    dd($creator->instagram_media);
//});


Route::get('/auth/{network}/redirect', [\App\Http\Controllers\Auth\AuthController::class, 'redirect']);
Route::get('/auth/{network}/callback', [\App\Http\Controllers\Auth\AuthController::class, 'callback']);
Route::get('/receive-sms', [\App\Http\Controllers\TwillioController::class, 'receiveSms']);
Route::post('/handle-failed-sms', [\App\Http\Controllers\TwillioController::class, 'handleFailedSms']);
Route::get('{any?}', function () {
    return view('welcome');
})->where('any', '.*')->name('welcome');
