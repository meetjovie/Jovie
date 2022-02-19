<?php

namespace App\Traits;

use App\Jobs\SendSlackNotification;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

trait ApifyYoutubeTrait
{

    private $APIFY_YOUTUBE_SCRAPPER_URL = "https://api.apify.com/v2/acts/bernardo~youtube-scraper/runs?token=y3fpJ9WSqanhXz4HoRAhmcuxc&waitForFinish=300";
    private $APIFY_YOUTUBE_POLL_URL = "https://api.apify.com/v2/acts/bernardo~youtube-scraper/runs/";
    private $APIFY_DATASET_URL = "https://api.apify.com/v2/datasets/";

    public function scrapYoutube($channel)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.apify.com/v2/acts/zThQGbEWsTZSEuTQn/runs?token=y3fpJ9WSqanhXz4HoRAhmcuxc&waitForFinish=300',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{"maxResults":3,"postsFromDate":"3 months","verboseLog":false,"handlePageTimeoutSecs":120,"proxyConfiguration":{"useApifyProxy":true,"apifyProxyCountry":"US"},"startUrls":[{"url":"'.$channel.'"}],"postsToDate":"today","extendOutputFunction":"async ({ item, page }) => {\\n  const xpath = \'//h2[@id=\\"count\\"]/yt-formatted-string/span[1]/text()\';\\n  await page.evaluate(() => window.scrollBy(0, 500));\\n  await page.waitForXPath(xpath);\\n  const count = await page.$x(xpath);\\n  let commentCount = +(await count[0].evaluate((s) => s.textContent.replace(/[^\\\\d]+/g, \'\'))); \\n\\n const xpathProfile = \'//div[@id=\\"top-row\\"]/ytd-video-owner-renderer/a/yt-img-shadow/img[1]/@src\';\\n  await page.waitForXPath(xpathProfile, {timeout: 3000});\\n  let profilePic = await page.$x(xpathProfile);\\n  profilePic = await profilePic[0].evaluate((s) => s.textContent);\\n\\n  let category = null;\\n const xpathCategory = \'//div[@id=\\"upload-info\\"]/ytd-channel-name/ytd-badge-supported-renderer/div[1]/@aria-label\'\\n  try {\\n    await page.waitForXPath(xpathCategory, {timeout: 5000});\\n  category = await page.$x(xpathCategory);\\n  category = await category[0].evaluate((s) => s.textContent);\\n  } catch(e) {\\n      //  \'not category tag\'\\n  }\\n  \\n let subscribers = null;\\n const xpathSubscribers = \'//div[@id=\\"upload-info\\"]/yt-formatted-string[@id=\\"owner-sub-count\\"]/@aria-label\'\\n  try {\\n    await page.waitForXPath(xpathSubscribers, {timeout: 2000});\\n  subscribers = await page.$x(xpathSubscribers);\\n  subscribers = await subscribers[0].evaluate((s) => s.textContent);\\n  } catch(e) {\\n      //  \'not subscribers tag\'\\n  }\\n  \\n let isReel = false;\\n\\n const xpathTags = \'//h1[@class=\\"title style-scope ytd-video-primary-info-renderer\\"]/yt-formatted-string/a\'\\n  try {\\n    await page.waitForXPath(xpathTags, {timeout: 2000});\\n    let tags = await page.$x(xpathTags);\\n    for (let index = 0; index < tags.length; index++) {\\n        let tag = tags[index]\\n        tag = await tag.evaluate((s) => s.textContent); \\n        if (tag == \'#shorts\') {\\n            isReel = true;\\n            break;\\n        }\\n    }\\n  } catch(e) {\\n      //  \'not tag tag\'\\n  }\\n  return {\\n    ...item,\\n    commentCount,\\n    profilePic, \\n    category,  \\n subscribers,  \\n isReel    }\\n}"}',
                CURLOPT_HTTPHEADER => array(
                    'authority: api.apify.com',
                    'pragma: no-cache',
                    'cache-control: no-cache',
                    'x-apify-request-origin: WEB',
                    'sec-ch-ua-mobile: ?0',
                    'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36',
                    'sec-ch-ua: " Not;A Brand";v="99", "Google Chrome";v="91", "Chromium";v="91"',
                    'content-type: application/json; charset=UTF-8',
                    'accept: */*',
                    'origin: https://console.apify.com',
                    'sec-fetch-site: same-site',
                    'sec-fetch-mode: cors',
                    'sec-fetch-dest: empty',
                    'referer: https://console.apify.com/',
                    'accept-language: en-US,en;q=0.9'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return ($response);

        } catch (\Exception $e) {
            SendSlackNotification::dispatch('Error on Youtube Import APIFY API '.$e->getMessage().'----'. $e->getFile(). '-----'.$e->getLine());
        }
    }

    public function dataSet($id)
    {
        $client = new Client();
        $response = $client->get($this->APIFY_DATASET_URL.$id.'/items?clean=true&format=json&?token=y3fpJ9WSqanhXz4HoRAhmcuxc');
        return json_decode($response->getBody()->getContents());
    }
}
