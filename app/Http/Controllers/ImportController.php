<?php

namespace App\Http\Controllers;

use App\Imports\FileSaveImport;
use App\Jobs\FileImport;
use App\Jobs\InstagramImport;
use App\Jobs\SaveImport;
use App\Jobs\SendSlackNotification;
use App\Models\Creator;
use App\Models\Import;
use App\Models\User;
use App\Models\UserList;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use function collect;

class ImportController extends Controller
{
    use GeneralTrait;

    public function getColumnsFromCsv(Request $request)
    {
        $stream = Import::getStream($request->input('key'));
        $reader = Reader::createFromStream($stream);
        $records = Import::records($reader, 0, 1);
        if (count($records)) {
            return collect([
                'status' => true,
                'columns' => $records->getRecords()->current()
            ]);
        }
        return collect([
            'status' => false,
            'columns' => [],
            'message' => 'No heading found.'
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'instagram' => 'required_without_all:key',
            'key' => 'required_without_all:instagram|nullable|string'
        ]);
        if ($request->instagram) {
            foreach (explode('\n', $request->instagram) as $instagram) {
                if ($instagram[0] == '@') {
                    $instagram = substr($instagram, 1);
                }
                InstagramImport::dispatch($instagram, $request->tags, true, null, null, null, Auth::user()->id);
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
                'error' => $e->getMessage(). $e->getLine()
            ]);
        }
        return collect([
            'status' => true,
            'message' => 'Successful. Your import will start soon.',
            'file' => $file,
            'queued_count' => Auth::user()->queued_count
        ]);
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
            SaveImport::dispatch($filePath, $mappedColumns, $request->tags, $listName, Auth::user()->id);
        }
        return $filePath;
    }

    public function importX(Request $request)
    {
        $request->validate([
            'instagram' => 'required_without_all:file,youtube',
//            'youtube' => 'required_without_all:file,instagram',
//            'file' => 'required_without_all:instagram,youtube|mimes:csv'
        ]);
        if ($request->instagram) {
            foreach (explode('\n', $request->instagram) as $instagram) {
                if ($instagram[0] == '@') {
                    $instagram = substr($instagram, 1);
                }
                Bus::chain([
                    new InstagramImport($instagram, $request->tags, true, null, null, null, Auth::user()->id),
                    new SendSlackNotification('imported instagram user '.$instagram)
                ])->dispatch();
            }
        }
        try {
            if ($request->file) {
                $this->handleImportFile($request);
            }
        } catch (\Exception $e) {
            return collect([
                'status' => false,
//                'error' => 'Your file is not imported.'
                'error' => $e->getMessage()
            ]);
        }
        return collect([
            'status' => true,
            'error' => 'success'
        ]);
    }

    public function handleImportFile($request)
    {
        $mappedColumns = json_decode($request->mappedColumns);
        if ($request->has('file')) {
            $fileUrl = self::uploadFile($request->file, Creator::CREATORS_CSV_PATH);
            $filename = explode(Creator::CREATORS_CSV_PATH, $fileUrl)[1];
            $filePath = Creator::CREATORS_CSV_PATH.$filename;
            $list = UserList::firstOrCreate([
                'user_id' => Auth::user()->id,
                'name' => $request->listName
            ], [
                'user_id' => Auth::user()->id,
                'name' => $request->listName
            ]);
            FileImport::dispatch($filePath, $mappedColumns, $request->tags, $list->id, Auth::user()->id);
        }
    }

    public function getImportBatches()
    {
        $userListIds = UserList::where('user_id', Auth::id())->pluck('id')->toArray();
        $batches = DB::table('job_batches')
            ->join('user_lists', 'user_lists.id', '=', 'job_batches.user_list_id')
            ->select('job_batches.*', 'user_lists.name')
            ->whereIn('user_list_id', $userListIds)
            ->get();
        $now = Carbon::now();
        foreach ($batches as &$batch) {
            $batch->progress = Import::getProgress($batch);
            $batch->successful = Import::getSuccessfulCount($batch);
            $batch->duration_formated = Carbon::createFromTimestamp($batch->created_at)->diffForHumans($now);
            unset($batch->options);
        }
        return response()->json([
            'status' => true,
            'batches' => $batches
        ], 200);
    }
}
