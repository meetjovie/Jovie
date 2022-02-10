<?php

namespace App\Traits;

use App\Jobs\SendSlackNotification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Artisan;
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
                    'timeout' => 30000
                ]
            ));
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            if ($e->getCode() == 402) {
                Artisan::command('php artisan queue:clear sqs');
            }
            SendSlackNotification::dispatch('Error on Instagram Import WEB SCRAPPER API '.$e->getMessage().'----'. $e->getFile(). '-----'.$e->getLine());
        }
    }

    public function getUserGender($name)
    {
        try {
            $client = new Client();
            $response = $client->get('https://gender-api.com/get?name='.$name.'&key=cElJXXxpyXcZSBCUKqaDLChNqmAD9kSb2tDF');
            $response = json_decode($response->getBody()->getContents());
            return $response->gender;
        } catch (Exception $exception) {
            return 'unknown';
        }
    }
}
