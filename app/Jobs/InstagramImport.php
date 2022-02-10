<?php

namespace App\Jobs;

use App\Models\Creator;
use App\Models\CreatorSocialLink;
use App\Models\SocialInfo;
use App\Notifications\ImportNotification;
use App\Traits\GeneralTrait;
use App\Traits\SocialScrapperTrait;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class InstagramImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SocialScrapperTrait, GeneralTrait;

    private $username;
    private $filepath;
    private $tags;
    private $brands = [];
    private $recursive = false;
    private $creatorId = null;
    private $parentCreator = null;
    private $email = null;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username, $tags, $recursive = false, $creatorId = null, $primaryEmail = null, $secondaryEmail = null)
    {
        $this->username = $username;
        $this->tags = $tags;
        $this->recursive = $recursive;
        $this->parentCreator = $creatorId;
        $this->primaryEmail = $primaryEmail;
        $this->secondaryEmail = $secondaryEmail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if ($this->username) {
                $response = self::scrapInstagram($this->username);
                $this->insertIntoDatabase($response);
            }
            if ($this->recursive) {
                foreach ($this->brands as $username) {
                    \App\Jobs\InstagramImport::dispatch($username, null, false, $this->creatorId);
                }
            }
        } catch (\Exception $e) {
//            SendSlackNotification::dispatch('Error on Instagram Import '.$e->getMessage().'----'. $e->getFile(). '-----'.$e->getLine());
        }
    }

    public function remove_emoji($string) {

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

        // Match Dingbats
        $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
        $clear_string = preg_replace($regex_dingbats, '', $clear_string);

        return $clear_string;
    }

    public function getOrCreateCreator($links, $creatorId)
    {
        if ($creatorId) return Creator::where('id', $creatorId)->first();

        if (!count($links)) return Creator::create();

        $links = array_map('strtolower', $links);
        $links = "'".implode("','", $links)."'";

        // check if youtube link exists in any social links of creator
        $socialLinkExists = collect(DB::select('select * from creator_social_links where lower(link) in ('.$links.') limit 1'))->first();
        if ($socialLinkExists) {
            return Creator::where('id', $socialLinkExists->creator_id)->first();
        }
        return Creator::create();
    }

    public function insertIntoDatabase($response)
    {
        if (isset($response->graphql)) {
            $user = $response->graphql->user;
            $socialInfo = SocialInfo::where('username', $this->username)->first();
            if (is_null($socialInfo)) {
                $socialInfo = new \App\Models\SocialInfo();
            }
            $links = $this->scrapLinkTree($user->external_url);
            $creator = $this->getOrCreateCreator($links, $socialInfo->creator_id);
            $creator->target_id = '-';
            $creator->location = $user->location ?? null;
            $creator->type = $user->type ?? 'CREATOR';
            $creator->status = $user->status ?? '-';
            $creator->tags = $this->getTags($this->tags, $creator);
            if (!$creator->gender_updated) {
                $creator->gender = self::getUserGender($user->full_name);
            }
            $creator->primary_email = $user->business_email ?? $this->getEmailFromBio($user->biography) ?? $this->email ?? $creator->primary_email;
            $creator->save();

            $socialInfo->creator_id = $creator->id;
            $socialInfo->type = $user->typename ?? '';
            if (!$socialInfo->name_updated) {
                $socialInfo->full_name = $this->remove_emoji($user->full_name);
            }
            $socialInfo->username = $user->username ?? '';
            $socialInfo->social_provider = $user->socialProvider ?? 'Instagram';
            $socialInfo->account_type = $this->getAccountType($user->is_business_account);
            $socialInfo->timeline_media = $this->getTimelineMedia($user);
            $socialInfo->followers = $user->edge_followed_by ? $user->edge_followed_by->count : 0;
            $socialInfo->business_category_name = $user->business_category_name ?? null;
            $socialInfo->category = $user->category_name ?? null;
            $engagementRate = $this->getEngagementRate($user);
            $followers = $this->getFollowers($user);
            $socialInfo->engagement_rate = $engagementRate;
            $socialInfo->social_id = $user->id;
            $socialInfo->engaged_follows = round(((($engagementRate / 100) * $followers) ?? 0), 2);
            $socialInfo->has_guides = $user->has_guides;
            $socialInfo->has_channel = $user->has_channel;
            $socialInfo->average_igtv_views = 0;
            $socialInfo->is_private = $user->is_private;
            $socialInfo->is_joined_recently = $user->is_joined_recently;
            $socialInfo->is_verified = $user->is_verified;
            $socialInfo->average_reel_views = 0;
            $socialInfo->biography = $user->biography;
            $socialInfo->has_clips = $user->has_clips;
            $averageLikesAndComments = $this->getAverageLikesAndComments($user);
            $socialInfo->average_comments = round($averageLikesAndComments['averageComments'], 2);
            $socialInfo->average_likes = round($averageLikesAndComments['averageLikes'], 2);
            $socialInfo->external_url = $user->external_url;
            $socialInfo->profile_pic_url = $this->getProfilePicUrl($user);
            $socialInfo->average_video_views = $this->getAverageVideoView($user);
            $socialInfo->has_blocked_viewer = $user->has_blocked_viewer;
            $socialInfo->is_business_account = $user->is_business_account;
            $socialInfo->has_ar_effects = $user->has_ar_effects;
            $socialInfo->save();
            if ($this->parentCreator && $socialInfo->account_type == 'BRAND') {
                $parentCreator = Creator::where('id', $this->parentCreator)->first();
                $parentCreator->brands()->syncWithoutDetaching($creator->id);
            }
            $this->creatorId = $creator->id;
            $this->addSocialLinksFromLinkTree($links, $creator->id);
        }
    }

    public function scrapLinkTree($url)
    {
        if (!$url || (strpos($url, 'linktree.com') === false)) return [];
        $client = new \Goutte\Client();// create a crawler object from this link
        $crawler = $client->request('GET', $url);
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
    }

    public function addSocialLinksFromLinkTree($links, $creator_id)
    {
        $socialLinks = collect();
        foreach ($links as $link) {
            $socialLinks->push([
                'link' => $link,
                'creator_id' => $creator_id,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            ]);
        }
        DB::table('creator_social_links')->upsert(
            $socialLinks->toArray(),
            ['link', 'creator_id'],
            ['link', 'updated_at']
        );
    }

    public function getAccountType($business)
    {
        return $business ? 'BRAND' : "CREATOR";
    }

    public function getEmailFromBio($bio)
    {
        $pattern = '/[a-z0-9_\-\+\.]+@[a-z0-9\-]+\.([a-z]{2,4})(?:\.[a-z]{2})?/i';
        preg_match_all($pattern, $bio, $matches);
        return $matches[0] ? ($matches[0][0] ?? null) : null;
    }
    public function getTags($tags, $creator)
    {
        if ($creator) {
            if (!$tags) return $creator->tags;
            $tags = explode(',', $tags);
            return array_map('trim', array_unique(array_merge($tags, $creator->tags ?? [])));
        }
        if (!$tags) return null;
        $tags = explode(',', $tags);
        return array_map('trim', $tags);
    }
    public function getProfilePicUrl($user)
    {
        $file = $user->profile_pic_url;
        if (is_null($file)) {
            $file = asset('images/thumnailLogo.5243720b.png');
        }
        if ($user->is_private) {
            $file = asset('images/thumbnailPrivateLogo.f3b513fc.png');
        }
        return self::uploadImage($file, \App\Models\SocialInfo::CREATORS_PROFILE_PATH);
    }

    public function getTimelineMedia($user)
    {
        $timelineMedia = collect();
        $mediaCount = 0;
        if ($user->edge_owner_to_timeline_media && $user->edge_owner_to_timeline_media->edges
            && count($user->edge_owner_to_timeline_media->edges)) {
            foreach ($user->edge_owner_to_timeline_media->edges as $edge) {
                if ($node = $edge->node) {
                    if ($node->is_video) {
                        $file = $node->thumbnail_src;
                    } else {
                        $file = $node->display_url;
                    }
                    if (is_null($file)) {
                        $file = asset('images/thumnailLogo.5243720b.png');
                    }
                    if ($user->is_private) {
                        $file = asset('images/thumbnailPrivateLogo.f3b513fc.png');
                    }
                    $display_url = self::uploadImage($file, \App\Models\SocialInfo::CREATORS_MEDIA_PATH);
                    $caption = '';
                    foreach ($node->edge_media_to_caption->edges as $captionNode) {
                        $caption .= $captionNode->node->text;
                    }
                    $timelineMedia->push([
                        'display_url' => $display_url,
                        'shortcode' => $node->shortcode,
                        'likes' => $node->edge_liked_by->count,
                        'comments' => $node->edge_media_to_comment->count,
                        'views' => $node->edge_media_preview_like->count,
                        'caption' => $caption,
                        'accessibility_caption' => $node->accessibility_caption
                    ]);
                    foreach ($node->edge_media_to_caption->edges as $edge) {
                        if ($caption = $edge->node) {
                            $this->getBrandsFromTimelineMediaCaptions($caption->text);
                        }
                    }
                    $mediaCount++;
                    if ($mediaCount == 3) break;
                }
            }
        }
        return $timelineMedia;
    }

    public function getBrandsFromTimelineMediaCaptions($caption)
    {
        if (preg_match_all('!@(.+)(?:\s|$)!U', $caption, $matches))
            $this->brands = array_unique(array_merge($matches[1], $this->brands));
        else
            $this->brands = array_unique(array_merge($matches[1], $this->brands));
    }

    public function getEngagementRate($user)
    {
        $averageLikesAndComments = $this->getAverageLikesAndComments($user);
        $averageLikes = $averageLikesAndComments['averageLikes'];
        $averageComments = $averageLikesAndComments['averageComments'];
        $followers = $this->getFollowers($user);
        return $followers ? ((($averageLikes + $averageComments) / $followers) * 100) : 0;
    }

    public function getFollowers($user)
    {
        return $user->edge_followed_by ? $user->edge_followed_by->count : 0;
    }

    public function getAverageLikesAndComments($user)
    {
        $totalLikes = 0;
        $totalComments = 0;
        $isFirstImage = true;
        $mediaCount = 0;
        if ($user->edge_owner_to_timeline_media && $user->edge_owner_to_timeline_media->edges
            && count($user->edge_owner_to_timeline_media->edges)) {
            foreach ($user->edge_owner_to_timeline_media->edges as $edge) {
                if ($node = $edge->node) {
                    if (!$node->is_video) {
                        if (!$isFirstImage) {
                            $totalLikes += $edge->node->edge_liked_by->count;
                            $totalComments += $edge->node->edge_media_to_comment->count;
                            $mediaCount++;
                        } else {
                            $isFirstImage = false;
                        }
                        if ($mediaCount == 3) break;
                    }
                }
            }
        }
        return collect([
            'averageLikes' => $mediaCount > 0 ? $totalLikes / $mediaCount : 0,
            'averageComments' => $mediaCount > 0 ? $totalComments / $mediaCount : 0,
        ]);
    }

    public function getAverageVideoView($user)
    {
        $reelViews = 0;
        $igtvViews = 0;
        $mediaCount = 0;
        if ($user->edge_owner_to_timeline_media && $user->edge_owner_to_timeline_media->edges
            && count($user->edge_owner_to_timeline_media->edges)) {
            foreach ($user->edge_owner_to_timeline_media->edges as $edge) {
                if ($node = $edge->node) {
                    if ($node->is_video) {
                        $reelViews += $edge->node->video_view_count;
                        $igtvViews += $edge->node->video_view_count;
                        $mediaCount++;
                        if ($mediaCount == 3) break;
                    }
                }
            }
        }
        return round(($mediaCount > 0 ? $reelViews / $mediaCount : 0), 2);
    }
}
