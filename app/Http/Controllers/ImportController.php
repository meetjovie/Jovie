<?php

namespace App\Http\Controllers;

use App\Imports\FileSaveImport;
use App\Jobs\FileImport;
use App\Jobs\InstagramImport;
use App\Jobs\SaveImport;
use App\Jobs\SendSlackNotification;
use App\Models\Creator;
use App\Models\User;
use App\Models\UserList;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\HeadingRowImport;
use function collect;

class ImportController extends Controller
{
    use GeneralTrait;

    public function getColumnsFromCsv(Request $request)
    {
//        $request->validate([
//            'import' => 'required|mimes:csv'
//        ]);
        $headings = (new HeadingRowImport)->toArray($request->import);
        if (count($headings)) {
            return collect([
                'status' => true,
                'columns' => $headings[0][0]
            ]);
        }
        return collect([
            'status' => false,
            'columns' => $headings[0][0],
            'message' => 'No heading found.'
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'instagram' => 'required_without_all:file,youtube',
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
                $this->saveImport($request);
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
            'queued_count' => Auth::user()->queued_count
        ]);
    }

    public function saveImport($request)
    {
        $mappedColumns = json_decode($request->mappedColumns);
        if ($request->has('file')) {
            $fileUrl = self::uploadFile($request->file, Creator::CREATORS_CSV_PATH);
            $filename = explode(Creator::CREATORS_CSV_PATH, $fileUrl)[1];
            $filePath = Creator::CREATORS_CSV_PATH.$filename;
            $listName = $request->listName;
            User::where('id', Auth::id())->increment('queued_count');
            SaveImport::dispatch($filePath, $mappedColumns, $request->tags, $listName, Auth::user()->id);
        }
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
}
