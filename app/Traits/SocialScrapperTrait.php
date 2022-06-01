<?php

namespace App\Traits;

use App\Jobs\SendSlackNotification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

trait SocialScrapperTrait {

    private $INSTAGRAM_SCRAPPER_URL = "https://api.webscraping.ai/html";
    public function scrapInstagram($username)
    {
        try {
            $url = ('https://www.instagram.com/'.$username.'/?__a=1&hl=en');
            $client = new \GuzzleHttp\Client();
            $response = $client->get($this->INSTAGRAM_SCRAPPER_URL, array(
                'query' => [
                    'api_key' => config('import.scrapper_api_key'),
                    'url' => $url,
                    'proxy' => 'residential',
                    'timeout' => 5000
                ]
            ));
            return $response;
        } catch (\Exception $e) {
            return $e->getResponse();
        }
    }

    public static function generateTwitchToken()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://id.twitch.tv/oauth2/token', array(
                'query' => [
                    'client_id' => config('import.twitch_client_id'),
                    'client_secret' => config('import.twitch_client_secret'),
                    'grant_type' => 'client_credentials',
                ]
            ));
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            return null;
        }
    }

    public function scrapTwitch($username, $token = null)
    {
        if (is_numeric($username)) {
            $query = [
                'id' => $username,
            ];
        } else {
            $query = [
                'login' => $username,
            ];
        }
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://api.twitch.tv/helix/users', array(
                'query' => $query,
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'client-id' => config('import.twitch_client_id')
                ]
            ));
            return $response;
        } catch (\Exception $e) {
            return $e->getResponse();
        }
    }

    public function scrapTwitchSummary($username)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->get('https://twitchtracker.com/api/channels/summary/'.$username);
            return $response;
        } catch (\Exception $e) {
            return $e->getResponse();
        }
    }

    public function getUserGender($name)
    {
        try {
            $client = new Client();
            $response = $client->get('https://gender-api.com/get?name='.$name.'&key=cElJXXxpyXcZSBCUKqaDLChNqmAD9kSb2tDF');
            return json_decode($response->getBody()->getContents());
        } catch (Exception $exception) {
            return 'unknown';
        }
    }
}
