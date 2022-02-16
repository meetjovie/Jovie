<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\FileImport;
use App\Jobs\InstagramImport;
use App\Jobs\SendSlackNotification;
use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\HeadingRowImport;

class ImportController extends Controller
{
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
    }

    public function handleImportFile($request)
    {
        $mappedColumns = json_decode($request->mappedColumns);
        if ($request->has('file')) {
//            $filepath = public_path('youtube.csv');
            $filePath = self::uploadFile($request->file, Creator::CREATORS_CSV_PATH);
//            $filePath = 'https://a7x3storage.s3.amazonaws.com/public/creators_csv/2022_01_01_135630_49568434761d05d8eb34470.92182953.txt';
            $filePath = explode('https://a7x3storage.s3.amazonaws.com/', $filePath)[1];
            FileImport::dispatch($filePath, $mappedColumns, $request->tags);
        }
    }
}
