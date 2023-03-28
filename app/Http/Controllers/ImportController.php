<?php

namespace App\Http\Controllers;

use App\Imports\FileSaveImport;
use App\Jobs\FileImport;
use App\Jobs\ImportFromSocialAndAddTOCrm;
use App\Jobs\InstagramImport;
use App\Jobs\SaveImport;
use App\Jobs\SendSlackNotification;
use App\Jobs\TiktokImport;
use App\Jobs\TwitchImport;
use App\Jobs\TwitterImport;
use App\Models\Contact;
use App\Models\Creator;
use App\Models\Import;
use App\Models\User;
use App\Models\UserList;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use function collect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ImportController extends Controller
{
    use GeneralTrait;

    public function getColumnsFromCsv(Request $request)
    {
        $stream = Import::getStream($request->input('key'));
        $reader = Reader::createFromStream($stream);
        $records = Import::records($reader, 0, 1);
        $totalRecords = $reader->count() - 1;
        $availableCredits = User::currentLoggedInUser()->currentTeam->credits ?? 0;
        if (count($records)) {
            return collect([
                'status' => true,
                'columns' => $records->getRecords()->current(),
                'fileCheck' => [
                    'count' => $totalRecords,
                    'limitExceeded' => $availableCredits < $totalRecords,
                    'availableCredits' => $availableCredits,
                ],
            ]);
        }

        return collect([
            'status' => false,
            'columns' => [],
            'message' => 'No heading found.',
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'instagram' => 'required_without_all:key,twitch,twitter,tiktok',
            'twitch' => 'required_without_all:instagram,twitter,tiktok,key',
            'twitter' => 'required_without_all:instagram,twitch,tiktok,key',
            'tiktok' => 'required_without_all:instagram,twitch,twitter,key',
            'key' => 'required_without_all:instagram,twitch,twitter,tiktok|nullable|string',
            'list' => 'sometimes|exists:user_lists,id',
            'list_name' => 'sometimes|max:255',
            'source' => 'sometimes|max:255',
        ]);

        $request->request->add(['override' => filter_var($request->override, FILTER_VALIDATE_BOOLEAN)]);
        $params = $this->getImportSocialParams($request);
        if ($request->instagram) {
            $usernames = explode(',', $request->instagram);
            foreach ($usernames as $username) {
                $import = new Import();
                $import->instagram = $username;
                $instagram = $import->instagram;
                if ($instagram[0] == '@') {
                    $instagram = substr($instagram, 1);
                }
                ImportFromSocialAndAddTOCrm::dispatch($instagram, 'instagram', $params)->onQueue(config('import.instagram_queue'));
            }
        }
        if ($request->twitch) {
            $usernames = explode(',', $request->twitch);
            foreach ($usernames as $username) {
                $import = new Import();
                $import->twitch = $username;
                $twitch = $import->twitch;
                ImportFromSocialAndAddTOCrm::dispatch($twitch, 'twitch', $params)->onQueue(config('import.twitch_queue'));
            }
        }
        if ($request->twitter) {
            $usernames = explode(',', $request->twitter);
            foreach ($usernames as $username) {
                $import = new Import();
                $import->twitter = $username;
                $twitter = $import->twitter;
                ImportFromSocialAndAddTOCrm::dispatch([$twitter], 'twitter', $params)->onQueue(config('import.twitter_queue'));
            }
        }
        if ($request->tiktok) {
            $usernames = explode(',', $request->tiktok);
            foreach ($usernames as $username) {
                $import = new Import();
                $import->tiktok = $username;
                $tiktok = $import->tiktok;
                ImportFromSocialAndAddTOCrm::dispatch($tiktok, 'tiktok', $params)->onQueue(config('import.tiktok_queue'));
            }
        }
        $file = null;
        try {
            if ($request->input('key')) {
                $file = $this->saveImport($request);
            }
        } catch (\Exception $e) {
            return collect([
                'status' => false,
                //                'error' => 'Your file is not imported.'
                'error' => $e->getMessage().$e->getLine(),
            ]);
        }

        return collect([
            'status' => true,
            'message' => 'Successful. Your import will start soon.',
            'file' => $file,
            'queued_count' => Auth::user()->queued_count,
        ]);
    }

    public function getImportSocialParams($request)
    {
        $params['user_id'] = Auth::id();
        $params['team_id'] = Auth::user()->currentTeam->id;
        $params['list_id'] = $request->list;
        if ($request->list_name) {
            $list = UserList::firstOrCreateList(Auth::id(), $request->list_name);
            if ($list) {
                $params['list_id'] = $list->id;
            }
        }
        if ($request->source) {
            $params['source'] = $request->source;
        }
        $params['override'] = $request->override;

        return $params;
    }

    public function saveImport($request)
    {
        $filePath = null;
        $mappedColumns = json_decode($request->mappedColumns);
        if ($request->input('key')) {
            Storage::disk('s3')->copy(
                ('tmp/'.$request->input('key')),
               (Creator::CREATORS_CSV_PATH.$request->input('key'))
            );
            $filePath = Creator::CREATORS_CSV_PATH.$request->input('key');
            $listName = $request->listName;
            $user = User::currentLoggedInUser();
            SaveImport::dispatch($filePath, $mappedColumns, $request->tags, $listName, $user->id, $user->currentTeam->id, true);
        }

        return $filePath;
    }

    public function importContact(Request $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $data['team_id'] = Auth::user()->currentTeam->id;
            $contact = Contact::saveContact($data, $request->list_id)->first();

            $params['user_id'] = Auth::id();
            $params['team_id'] = Auth::user()->currentTeam->id;
            $params['id'] = $contact->id;
            $params['type'] = 'list';
            $params['list'] = $request->list_id;
            $contact = Contact::getContacts($params)->first();

            return collect([
                'status' => true,
                'message' => 'Successful. Your contact is imported.',
                'contact' => $contact,
                'list' => $request->list_id,
            ]);

        } catch (\Exception $e) {
            return collect([
                'status' => false,
                'error' => $e->getMessage().$e->getLine(),
            ]);
        }
    }

    public function handleImportFile($request)
    {
        $mappedColumns = json_decode($request->mappedColumns);
        if ($request->has('file')) {
            $fileUrl = self::uploadFile($request->file, Creator::CREATORS_CSV_PATH);
            $filename = explode(Creator::CREATORS_CSV_PATH, $fileUrl)[1];
            $filePath = Creator::CREATORS_CSV_PATH.$filename;
            $list = UserList::firstOrCreateList(Auth::user()->id, $request->listName);
            FileImport::dispatch($filePath, $mappedColumns, $request->tags, $list->id, Auth::user()->id);
        }
    }
}
