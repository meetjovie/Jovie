<?php

namespace App\Console\Commands;

use App\Imports\ImportFileImport;
use App\Models\Creator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class SaveImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $file = fopen('https://jovie-production-store.s3.amazonaws.com/public/creators_csv/tmp/8dc40977-e644-4b2d-b532-d6669b9df3d9', 'r');
        dd($file);
        Storage::disk('local')->put(
            'filename.csv',
            Storage::disk('s3')->get(Creator::CREATORS_CSV_PATH.'a7e04713-2a96-4ecf-aebf-d11386a72e57'));
        dd(1);
        $fileImport = new ImportFileImport();
        $collection = Excel::import($fileImport, Creator::CREATORS_CSV_PATH.'a7e04713-2a96-4ecf-aebf-d11386a72e57', 's3', \Maatwebsite\Excel\Excel::CSV); // file is now loaded in results, so don't need it
            dd($collection);
        $results = $fileImport->data;
        dd($results);
    }
}
