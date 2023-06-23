<?php

namespace App\Traits;

use App\Jobs\SendSlackNotification;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

trait SocialScrapperTrait
{
    use GeneralTrait;

    private $INSTAGRAM_SCRAPPER_URL = 'https://api.webscraping.ai/html';

    public function scrapInstagram($username)
    {
        try {
            $url = ('https://www.instagram.com/' . $username . '/?__a=1&hl=en');
            $client = new \GuzzleHttp\Client();
            $response = $client->get($this->INSTAGRAM_SCRAPPER_URL, [
                'query' => [
                    'api_key' => config('import.scrapper_api_key'),
                    'js' => false,
                    'url' => $url,
                    'proxy' => 'residential',
                    'timeout' => 10000,
                ],
            ]);

            return $response;
        } catch (\Exception $e) {
            return $e->getResponse();
        }
    }

    public static function generateTwitchToken()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->post('https://id.twitch.tv/oauth2/token', [
                'query' => [
                    'client_id' => config('import.twitch_client_id'),
                    'client_secret' => config('import.twitch_client_secret'),
                    'grant_type' => 'client_credentials',
                ],
            ]);

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
            $response = $client->get('https://api.twitch.tv/helix/users', [
                'query' => $query,
                'headers' => [
                    'Authorization' => "Bearer {$token}",
                    'client-id' => config('import.twitch_client_id'),
                ],
            ]);

            return $response;
        } catch (\Exception $e) {
            return $e->getResponse();
        }
    }

    public function scrapTwitchSummary($username)
    {
        try {
            $client = new Client();
            $headers = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ];
            $response = $client->get('https://twitchtracker.com/api/channels/summary/' . $username, [
                'headers' => $headers,
            ]);

            return $response;
        } catch (\Exception $e) {
            return $e->getResponse();
        }
    }

    public function getUserGender($name)
    {
        try {
            $client = new Client();
            $response = $client->get(
                'https://gender-api.com/get?name=' . $name . '&key=cElJXXxpyXcZSBCUKqaDLChNqmAD9kSb2tDF'
            );

            return json_decode($response->getBody()->getContents());
        } catch (Exception $exception) {
            return (object) ['gender' => null];
        }
    }

    public function scrapTwitter($username)
    {
        if (is_array($username)) {
            $username = implode(',', $username);
        }
        try {
            $client = new \GuzzleHttp\Client();
            $token = config('import.twitter_bearer_token');
            $response = $client->get("https://api.twitter.com/2/users/by", [
                'query' => [
                    'usernames' => $username,
                    'user.fields' => 'created_at,description,entities,id,location,name,pinned_tweet_id,profile_image_url,protected,public_metrics,url,username,verified,withheld'
                ],
                'headers' => [
                    'Authorization' => "Bearer $token",
                ],
            ]);

            return $response;
        } catch (\Exception $e) {
            return $e->getResponse();
        }
    }

    public function scrapTiktok($username)
    {
        if ($username[0] !== '@') {
            $username = "@$username";
        }
        try {
            $url = "https://www.tiktok.com/$username";
            $client = new \Goutte\Client(); // create a crawler object from this link
            $crawler = $client->request('GET', $url);

            $internalResponse = $client->getInternalResponse();
            if ($internalResponse->getStatusCode() == 404) {
                return (object)[
                    'code' => 404,
                    'message' => "User not found"
                ];
            } elseif ($internalResponse->getStatusCode() == 429) {
                return (object)[
                    'code' => 429,
                    'message' => "Too many requests."
                ];
            } elseif ($internalResponse->getStatusCode() == 504) {
                return (object)[
                    'code' => $internalResponse->getStatusCode(),
                    'message' => $internalResponse->getContent()
                ];
            }
            $name = @$crawler->filterXPath('//h1[contains(@data-e2e,"user-subtitle")]')->first()->getNode(
                0
            )->firstChild->data;
            $followers = @$crawler->filterXPath('//strong[contains(@data-e2e,"followers-count")]')->first()->getNode(
                0
            )->firstChild->data;

            $following = @$crawler->filterXPath('//strong[contains(@data-e2e,"following-count")]')->first()->getNode(
                0
            )->firstChild->data;
            $likes = @$crawler->filterXPath('//strong[contains(@data-e2e,"likes-count")]')->first()->getNode(
                0
            )->firstChild->data;
            $biography = @$crawler->filterXPath('//h2[contains(@data-e2e,"user-bio")]')->first()->getNode(
                0
            )->firstChild->data;
            $website = @$crawler->filterXPath('//a[contains(@data-e2e,"user-link")]')->first()->getNode(
                0
            )->lastChild->firstChild->data;
            $profilePicUrl = @$crawler->filterXPath(
                '//div[contains(@data-e2e,"user-avatar")]/span[@shape="circle"]/img[@loading="lazy"]'
            )->first()->extract(['src'])[0];
            $post1 = @$crawler->filterXPath(
                '//div[contains(@data-e2e,"user-post-item")]/div[1]/div/div/div/a/div/div/img'
            )->first()->extract(['src'])[0];
            $url1 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[1]/div/div/div/a')->first(
            )->extract(['href'])[0];
            $post2 = @$crawler->filterXPath(
                '//div[contains(@data-e2e,"user-post-item")]/div[2]/div/div/div/a/div/div/img'
            )->first()->extract(['src'])[0];
            $url2 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[2]/div/div/div/a')->first(
            )->extract(['href'])[0];
            $post3 = @$crawler->filterXPath(
                '//div[contains(@data-e2e,"user-post-item")]/div[3]/div/div/div/a/div/div/img'
            )->first()->extract(['src'])[0];
            $url3 = @$crawler->filterXPath('//div[contains(@data-e2e,"user-post-item")]/div[3]/div/div/div/a')->first(
            )->extract(['href'])[0];

            $timelineMedia = [
                [
                    'thumbnail' => $post1,
                    'url' => $url1,
                    'likes' => 0,
                    'shares' => 0,
                    'comments' => 0,
                    'post_date' => '',
                    'caption' => '',
                ],
                [
                    'thumbnail' => $post2,
                    'url' => $url2,
                    'likes' => 0,
                    'shares' => 0,
                    'comments' => 0,
                    'post_date' => '',
                    'caption' => '',
                ],
                [
                    'thumbnail' => $post3,
                    'url' => $url3,
                    'likes' => 0,
                    'shares' => 0,
                    'comments' => 0,
                    'post_date' => '',
                    'caption' => '',
                ],
            ];
            $likes = self::convertToNumber($likes);
            $followers = self::convertToNumber($followers);
            if ($followers >= 10000) {
                foreach ($timelineMedia as &$media) {
                    if (isset($media['url'])) {
                        $url = $media['url'];
                        $client = new \Goutte\Client(); // create a crawler object from this link
                        $crawler = $client->request('GET', $url);
                        $mediaLikes = @$crawler->filterXPath('//strong[contains(@data-e2e,"like-count")]')->first(
                        )->getNode(0)->firstChild->data;
                        $media['likes'] = self::convertToNumber($mediaLikes);
                        $mediaShares = @$crawler->filterXPath('//strong[contains(@data-e2e,"share-count")]')->first(
                        )->getNode(0)->firstChild->data;
                        $media['shares'] = self::convertToNumber($mediaShares);
                        $mediaComments = @$crawler->filterXPath(
                            '//strong[contains(@data-e2e,"comment-count")]'
                        )->first()->getNode(0)->firstChild->data;
                        $media['comments'] = self::convertToNumber($mediaComments);
                        $media['post_date'] = @$crawler->filterXPath(
                            '//span[contains(@data-e2e,"browser-nickname")]/span[3]'
                        )->first()->getNode(0)->firstChild->data;

                        $caption = ' ';
                        @$crawler->filterXPath('//div[contains(@data-e2e,"browse-video-desc")]')->children()->each(function ($node) use (&$caption) {
                            $text = $node->extract(['_text'])[0];
                            if (! str_contains($text, '.tiktok')) {
                                $caption .= $text;
                            }
                        });
                        $media['caption'] = $caption ?? null;
                    }
                }
            }

            $user = (object)[];
            $user->username = $username;
            $user->name = $name;
            $user->followers = $followers;
            $user->following = $following;
            $user->likes = $likes;
            $user->biography = $biography;
            $user->website = $website;
            $user->profile_image_url = $profilePicUrl;
            $user->timeline_media = $timelineMedia;
            return $user;
        } catch (\Exception $e) {
            return (object)[
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ];
        }
    }

    public function remove_emoji($string)
    {

        // Match Enclosed Alphanumeric Supplement
        $regex_alphanumeric = '/[\x{1F100}-\x{1F1FF}]/u';
        $clear_string = preg_replace($regex_alphanumeric, '', $string);

        // Match Miscellaneous Symbols and Pictographs
        $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $clear_string = preg_replace($regex_symbols, '', $clear_string);

        // Match Emoticons
        $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $clear_string = preg_replace($regex_emoticons, '', $clear_string);

        // Match Transport And Map Symbols
        $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
        $clear_string = preg_replace($regex_transport, '', $clear_string);

        // Match Supplemental Symbols and Pictographs
        $regex_supplemental = '/[\x{1F900}-\x{1F9FF}]/u';
        $clear_string = preg_replace($regex_supplemental, '', $clear_string);

        // Match Miscellaneous Symbols
        $regex_misc = '/[\x{2600}-\x{26FF}]/u';
        $clear_string = preg_replace($regex_misc, '', $clear_string);

        // Match Miscellaneous Symbols
        $regex_special = '/[^a-zA-Z0-9\s\-\._]/';
        $clear_string = preg_replace($regex_special, '', $clear_string);

        // Match Dingbats
        $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';

        return preg_replace($regex_dingbats, '', $clear_string);
    }
}
