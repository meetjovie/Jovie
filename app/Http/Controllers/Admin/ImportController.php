<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\FileImport;
use App\Jobs\InstagramImport;
use App\Jobs\SendSlackNotification;
use App\Models\Creator;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\HeadingRowImport;

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
//            'youtube' => 'required_without_all:file,instagram',
//            'file' => 'required_without_all:instagram,youtube|mimes:csv'
        ]);
        if ($request->instagram) {
            foreach (explode('\n', $request->instagram) as $instagram) {
                if ($instagram[0] == '@') {
                    $instagram = substr($instagram, 1);
                }
                Bus::chain([
                    new InstagramImport($instagram, $request->tags, true),
                    new SendSlackNotification('imported instagram user '.$instagram)
                ])->dispatch();
            }
        }
        try {
            $this->handleImportFile($request);
        } catch (\Exception $e) {
            return collect([
                'status' => false,
//                'error' => 'Your file is not imported.'
                'error' => $e->getMessage()
            ]);
        }
    }

    public function handleImportFile($request)
    {
        $mappedColumns = json_decode($request->mappedColumns);
        if ($request->has('file')) {
            $filePath = self::uploadFile($request->file, Creator::CREATORS_CSV_PATH);
            FileImport::dispatch($filePath, $mappedColumns, $request->tags);
        }
    }
}
