<?php

namespace App\Jobs;

use App\Models\Creator;
use App\Models\CreatorSocialLink;
use App\Models\Youtube;
use App\Traits\ApifyYoutubeTrait;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;

class YoutubeImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use ApifyYoutubeTrait;

    private $youtube;

    private $tags;

    private $email;

    private $isVanityUrl;

    private $channelId = null;

    private $channelUsername = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($youtube, $tags = null, $email = null)
    {
        $this->youtube = $youtube;
        $this->tags = $tags;
        $this->email = $email;
        $this->isVanityUrl = $this->checkIfItsVanityUrl($youtube);
        $this->getYoutubeIdOrChannelUsername($youtube);
    }

    public function getYoutubeIdOrChannelUsername($youtube)
    {
        if ($this->checkIfItsVanityUrl($youtube)) {
            $this->channelUsername = explode('/c/', $youtube)[1] ?? null;
        } else {
            $this->channelId = explode('/channel/', $youtube)[1] ?? null;
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $response = $this->scrapYoutube($this->youtube);
            $isVanityUrl = $this->checkIfItsVanityUrl($this->youtube);

//        $response = '{
//    "data": {
//        "id": "T691p4A4xMGiIMwDI",
//        "actId": "zThQGbEWsTZSEuTQn",
//        "userId": "MDD7FZKbSPsxaKqAw",
//        "startedAt": "2021-11-30T21:11:09.164Z",
//        "finishedAt": "2021-11-30T21:11:36.522Z",
//        "status": "SUCCEEDED",
//        "meta": {
//            "origin": "WEB",
//            "userAgent": "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.77 Safari/537.36"
//        },
//        "stats": {
//            "inputBodyLen": 756,
//            "restartCount": 0,
//            "durationMillis": 27177,
//            "resurrectCount": 0,
//            "runTimeSecs": 27.177,
//            "metamorph": 0,
//            "computeUnits": 0.030196666666666667,
//            "memAvgBytes": 339486413.7025616,
//            "memMaxBytes": 674234368,
//            "memCurrentBytes": 0,
//            "cpuAvgUsage": 71.73835511736299,
//            "cpuMaxUsage": 219.92299582760774,
//            "cpuCurrentUsage": 0,
//            "netRxBytes": 7647096,
//            "netTxBytes": 218473
//        },
//        "options": {
//            "build": "latest",
//            "timeoutSecs": 604800,
//            "memoryMbytes": 4096,
//            "diskMbytes": 8192
//        },
//        "buildId": "VgF8YMbco0EeYqXgY",
//        "exitCode": 0,
//        "defaultKeyValueStoreId": "q4rd6GJjkS6CUzJzX",
//        "defaultDatasetId": "ccr7GVG21tRqa7s5y",
//        "defaultRequestQueueId": "FweC5XJnoosH8DSbt",
//        "buildNumber": "0.0.51",
//        "containerUrl": "https://5ixvrvst6rjd.runs.apify.net"
//    }
            //}';
            $response = json_decode($response);
            if (isset($response->data) && $response->data && $response->data->status == 'SUCCEEDED') {
                $videos = $this->dataSet($response->data->defaultDatasetId);

                // check if we already scrapped this youtube channel
                $youtube = Youtube::whereRaw('lower(channel_vanity_url) = ?', [strtolower($this->channelUsername)])
                    ->orWhereRaw('lower(channel_url) = ?', [$this->channelId])->first();

                // if there is no youtube data with that link and the video count is also 0 no need to save that channel
                if (is_null($youtube) && ! count($videos)) {
                    return;
                }
                // if there is no youtube data with that link try with the channel id link from videos if there are any videos in scrap
                // and youtube link was vanity
                if (is_null($youtube) && count($videos) && $isVanityUrl) {
                    $youtube = Youtube::whereRaw('lower(channel_url) = ?', [strtolower(explode('/channel/', $videos[0]->channelUrl)[1])])->first();
                }

                if (is_null($youtube)) {
                    $youtube = new Youtube();
                }

                $creator = $this->getOrCreateCreator($videos, $youtube->creator_id);
                $creator->tags = $this->getTags($this->tags, $creator);
                $creator->primary_email = $this->email ?? $creator->primary_email;
                $creator->save();

                $youtube->creator_id = $creator->id;
                if (count($videos)) {
                    if (is_null($this->channelId)) {
                        $this->getYoutubeIdOrChannelUsername($videos[0]->channelUrl);
                    }
                    $youtube->full_name = $videos[0]->channelName;
                    $youtube->channel_url = $youtube->channel_url ?? $this->channelId;
                    $youtube->channel_vanity_url = $youtube->channel_vanity_url ?? $this->channelUsername;
                    $youtube->followers = $videos[0]->numberOfSubscribers;
                    $youtube->profile_pic_url = str_replace('=s48', '=s200', $videos[0]->profilePic);
                    $youtube->category = $videos[0]->category != 'Verified' ? $videos[0]->category : null;
                    $youtube->is_verified = $videos[0]->category == 'Verified' ? 1 : 0;
                    $youtube->is_private = is_null($videos[0]->subscribers) ? 1 : 0;
                }

                $timelineMedia = collect();
                if (! count($videos) && $youtube->timeline_media) {
                    $timelineMedia = $youtube->timeline_media;
                    foreach ($timelineMedia as $k => $video) {
                        $timelineMedia[$k]->is_deleted = true;

                        if ($k <= 2) {
                            $engagementRate = $video->subscribers ? ($video->likes * ($video->commentCount * 2) / $video->numberOfSubscribers) : 0;
                        }
                    }
                    $youtube->engagement_rate = $engagementRate / (count($videos) < 3 ? count($videos) : 3);
                    $youtube->engaged_follows = round(((($youtube->engagement_rate / 100) * $youtube->followers) ?? 0), 2);
                } else {
                    $engagementRate = 0;
                    $averageLikes = 0;
                    $averageComments = 0;
                    $averageViews = 0;
                    $averageReelViews = 0;
                    $reelCount = 0;
                    $videoCount = 0;
                    foreach ($videos as $k => $video) {
                        $videoCount++;
                        $timelineMedia->push([
                            'id' => $video->id,
                            'title' => $video->title,
                            'url' => $video->url,
                            'display_url' => ('https://img.youtube.com/vi/'.$video->id.'/0.jpg'),
                            'likes' => $video->likes,
                            'comments' => $video->commentCount,
                            'views' => $video->viewCount,
                            'duration' => $video->duration,
                            'date' => Carbon::parse($video->date)->toDateTimeString(),
                            'details' => strip_tags($video->details),
                            'isReel' => $video->isReel,
                        ]);
                        if ($k <= 2) {
                            $averageLikes += $video->likes;
                            $averageComments += $video->commentCount;
                            $averageViews += $video->viewCount;
                            if ($video->isReel) {
                                $averageReelViews += $video->viewCount;
                                $reelCount++;
                            }
                            $engagementRate = $video->subscribers ? ($video->likes * ($video->commentCount * 2) / $video->numberOfSubscribers) : 0;
                        }
                    }
                    if ($videoCount) {
                        $youtube->average_likes = $averageLikes / $videoCount;
                        $youtube->average_comments = $averageComments / $videoCount;
                        $youtube->average_views = $averageViews / $videoCount;
                        $youtube->engagement_rate = $engagementRate / $videoCount;
                    }
                    if ($reelCount) {
                        $youtube->average_reel_views = $averageReelViews / $reelCount;
                    }
                    $youtube->engaged_follows = round(((($youtube->engagement_rate / 100) * $youtube->followers) ?? 0), 2);
                }
                $youtube->timeline_media = $timelineMedia;
                $youtube->save();
                SendSlackNotification::dispatch('imported youtube channel '.$this->youtube);
            } else {
                SendSlackNotification::dispatch(('Youtube import is timed out for channel '.$this->youtube.'\\n '.json_encode($response)));
            }
        } catch (Exception $e) {
//            SendSlackNotification::dispatch('Error on Youtube Import '.$e->getMessage().'----'. $e->getFile(). '-----'.$e->getLine());
        }
    }

    public function getTags($tags, $creator)
    {
        if ($creator) {
            if (! $tags) {
                return $creator->tags;
            }
            $tags = explode(',', $tags);

            return array_map('trim', array_unique(array_merge($tags, $creator->tags ?? [])));
        }
        if (! $tags) {
            return null;
        }
        $tags = explode(',', $tags);

        return array_map('trim', $tags);
    }

    public function checkIfItsVanityUrl($url)
    {
        return strpos($url, '/c/') !== false ? $url : null;
    }

    private function getOrCreateCreator($videos, $creatorId)
    {
        if ($creatorId) {
            return Creator::where('id', $creatorId)->first();
        }

        $youtubeLinks = [$this->youtube];
        if (count($videos)) {
            $youtubeLinks[] = $videos[0]->channelUrl;
        }
        $youtubeLinks = array_map('strtolower', $youtubeLinks);
        $youtubeLinks = "'".implode("','", $youtubeLinks)."'";

        // check if youtube link exists in any social links of creator
        $socialLinkExists = collect(DB::select('select * from creator_social_links where lower(link) in ('.$youtubeLinks.') limit 1'))->first();
        if ($socialLinkExists) {
            Creator::where('id', $socialLinkExists->creator_id)->first();
        }

        return Creator::create();
    }
}
