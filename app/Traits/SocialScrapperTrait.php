<?php

namespace App\Traits;

use App\Jobs\SendSlackNotification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Artisan;
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
                    'timeout' => 50000
                ]
            ));
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
