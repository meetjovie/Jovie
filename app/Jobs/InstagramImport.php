<?php

namespace App\Jobs;

use App\Models\Creator;
use App\Models\CreatorSocialLink;
use App\Models\Crm;
use App\Models\SocialInfo;
use App\Models\User;
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
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class InstagramImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SocialScrapperTrait, GeneralTrait;

    private $username;
    private $tags;
    private $recursive;
    private $creatorId;
    private $parentCreator;
    private $meta;
    private $brands = [];
    private $listId;
    private $userId;
    private $platformUser;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username, $tags, $recursive = false, $creatorId = null, $meta = null, $listId = null, $userId = null)
    {
        $this->username = $username;
        $this->tags = $tags;
        $this->recursive = $recursive;
        $this->parentCreator = $creatorId;
        $this->meta = $meta;
        $this->listId = $listId;
        $this->userId = $userId;
        $this->platformUser = User::where('id', $this->userId)->first();

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if (is_null($this->platformUser)) {
                return;
            }
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
            dd($e->getMessage(), $e->getLine(), $e->getFile());
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
        return preg_replace($regex_dingbats, '', $clear_string);
    }

    public function getOrCreateCreator($links = [])
    {
        $creator = Creator::where('instagram_handler', $this->username)->first();
        if ($creator) {
            return $creator;
        }
        if (!count($links)) return new Creator();

        $links = array_map('strtolower', $links);

        // check if instagram link exists in any social links of creator
        $creator = Creator::select('id', 'social_links')
            ->whereJsonContains(DB::raw('lower("social_links"::text)'), $links)->first();

        return $creator ?? new Creator();
    }

    public function insertIntoDatabase($response)
    {
        if (!is_null($response) && isset($response->graphql)) {
            $user = $response->graphql->user;
            $links = $this->scrapLinkTree($user->external_url);
            $creator = $this->getOrCreateCreator($links);

            if (isset($this->meta->socialHandlers)) {
                foreach ($this->meta->socialHandlers as $k => $handler) {
                    $creator[$k] = $handler;
                }
            }
            $creator->save();
            dd($creator);
            $creator->first_name = $this->platformUser->is_admin ? ($this->meta['firstName'] ??  $creator->first_name ?? null) : null;
            $creator->last_name = $this->platformUser->is_admin ? ($this->meta['lastName'] ??  $creator->last_name ?? null) : null;
            $creator->city = $creator->city ?? $this->meta['city'] ?? null;
            $creator->country = $creator->country ?? $this->meta['country'] ?? null;
            $creator->wiki_id = $creator->wiki_id ?? $this->meta['wikiId'] ?? null;
            $creator->full_name = $user->full_name;
            $creator->social_links = $this->addSocialLinksFromLinkTree($links, $creator->social_links);
            $creator->location = $user->location ?? null;
            $creator->type = $user->typename ?? 'CREATOR';
            $creator->tags = $this->getTags($this->tags, $creator);
            if (!$creator->gender_updated) {
                // first check if instagram has pronouns check for gender in it
                // in case not found hit gender api
                $gender = 'unknown';
                $genderAccuracy = 0;
                $pronouns = $user->pronouns;
                if (count($pronouns ?? [])) {
                    if (in_array('she', $pronouns) || in_array('her', $pronouns) || in_array('hers', $pronouns)) {
                        $gender = 'female';
                        $genderAccuracy = 100;
                    } elseif (in_array('he', $pronouns) || in_array('him', $pronouns) || in_array('his', $pronouns)) {
                        $gender = 'male';
                        $genderAccuracy = 100;
                    }
                }
                if ($gender == 'unknown') {
                    $genderResponse = self::getUserGender($user->full_name);
                    $gender = $genderResponse->gender;
                    $genderAccuracy = $genderResponse->accuracy;
                }
                $creator->gender = $gender;
                $creator->gender_accuracy = $genderAccuracy;
            }

            $creator->emails = $this->getEmails($user, $creator->emails);

            if (!$creator->instagram_name_updated) {
                $creator->instagram_name = $this->remove_emoji($user->full_name);
            }
            $creator->instagram_handler = $user->username;
            $creator->account_type = $this->getAccountType($user->is_business_account);

            $creator->instagram_media = $this->getTimelineMedia($user, $creator);
            $creator->instagram_followers = $this->getFollowers($user);
            $creator->instagram_category = $user->category_name ?? null;

            $creator->instagram_engagement_rate = $this->getEngagementRate($user);
            $creator->instagram_biography = $user->biography;
            $creator->instagram_is_private = $user->is_private;
            $creator->instagram_is_verified = $user->is_verified;

            // meta
            $meta['fbid'] = $user->fbid;
            $meta['engaged_follows'] = $this->getEngagedFollows($creator->instagram_engagement_rate, $creator->instagram_followers);
            $meta['business_category_name'] = $user->business_category_name ?? null;
            $meta['has_guides'] = $user->has_guides;
            $meta['has_channel'] = $user->has_channel;
            $meta['average_igtv_views'] = 0;
            $meta['is_joined_recently'] = $user->is_joined_recently;
            $meta['has_clips'] = $user->has_clips;
            $averageLikesAndComments = $this->getAverageLikesAndComments($user);
            $meta['average_comments'] = $averageLikesAndComments['averageComments'];
            $meta['average_likes'] = $averageLikesAndComments['averageLikes'];
            $meta['external_url'] = $user->external_url;
            $meta['profile_pic_url'] = $this->getProfilePicUrl($user, $creator);
            $meta['average_video_views'] = $this->getAverageVideoView($user);
            $meta['has_blocked_viewer'] = $user->has_blocked_viewer;
            $meta['is_business_account'] = $user->is_business_account;
            $meta['has_ar_effects'] = $user->has_ar_effects;
            $creator->instagram_meta = json_encode($meta);
            $creator->save();
            if ($this->listId) {
                $creator->userLists()->syncWithoutDetaching($this->listId);
            }
            if ($this->userId) {
                $creator->crms()->syncWithoutDetaching($this->userId);
            }
            if ($this->parentCreator && $creator->account_type == 'BRAND') {
                $parentCreator = Creator::where('id', $this->parentCreator)->first();
                $parentCreator->brands()->syncWithoutDetaching($creator->id);
            }
            $this->creatorId = $creator->id;
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

    public function addSocialLinksFromLinkTree($links, $oldLinks = [])
    {
        return json_encode(array_values(array_map('trim', array_unique(array_merge($links, $oldLinks)))));
    }

    public function getEmails($user, $oldEmails)
    {
        $emails = [];
        if (isset($this->meta['emails']) && count($this->meta['emails']) && $this->platformUser->is_admin) {
            $emails = $this->meta['emails'];
        }
        if ($user->business_email) {
            $emails[] = $user->business_email;
        }
        if ($bioEmail = $this->getEmailFromBio($user->biography)) {
            $emails[] = $bioEmail;
        }
        return json_encode(array_values(array_map('trim', array_unique(array_merge($emails, $oldEmails)))));
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
            if (!$tags) return json_encode($creator->tags);
            $tags = explode(',', $tags);
            return json_encode(array_values(array_map('trim', array_unique(array_merge($tags, $creator->tags ?? [])))));
        }
        if (!$tags) return '[]';
        $tags = explode(',', $tags);
        return json_encode(array_values(array_map('trim', $tags)));
    }

    public function getProfilePicUrl($user, $creator)
    {
        try {
            $filename = explode(Creator::CREATORS_PROFILE_PATH, $creator->instagram_meta->profile_pic_url)[1];
            $path = Creator::CREATORS_MEDIA_PATH.$filename;
            Storage::disk('s3')->delete($path);
        } catch (\Exception $e) {
        }
        $file = $user->profile_pic_url_hd;
        if (is_null($file)) {
            $file = asset('images/thumnailLogo.5243720b.png');
        }
        if ($user->is_private) {
            $file = asset('images/thumbnailPrivateLogo.f3b513fc.png');
        }
        return self::uploadFile($file, Creator::CREATORS_PROFILE_PATH);
    }

    public function getTimelineMedia($user, $creator)
    {
        foreach ($creator->instagram_media as $media) {
            try {
                $filename = explode(Creator::CREATORS_MEDIA_PATH, $media->display_url)[1];
                $path = Creator::CREATORS_MEDIA_PATH.$filename;
                Storage::disk('s3')->delete($path);
            } catch (\Exception $e) {

            }
        }
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
                    $display_url = self::uploadFile($file, Creator::CREATORS_MEDIA_PATH);
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
        return json_encode($timelineMedia->toArray());
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
        return round($followers ? ((($averageLikes + $averageComments) / $followers) * 100) : 0, 2);
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
            'averageLikes' => round($mediaCount > 0 ? $totalLikes / $mediaCount : 0, 2),
            'averageComments' => round($mediaCount > 0 ? $totalComments / $mediaCount : 0, 2),
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

    private function getFollowers($user)
    {
        return round($user->edge_followed_by ? $user->edge_followed_by->count : 0, 2);
    }

    private function getEngagedFollows($engagementRate, $followers)
    {
        return round(((($engagementRate / 100) * $followers) ?? 0), 2);
    }
}
