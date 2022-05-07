<?php

namespace App\Console\Commands;

use App\Models\Creator;
use Aws\S3\S3Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use function Clue\StreamFilter\fun;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test {path} {page=1}';

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

    const PER_PAGE = 500;
    protected $page = null;
    protected $path = null;

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
        //        $url = 'https://jovie-production-store.s3.amazonaws.com/public/creators_csv/f2afcb9f-6d43-42c9-a30f-b3bfdc3a8058';

        $ecode = base64_encode(json_encode(['s' => 3]));
        $decode = base64_decode($ecode);
        dd(json_decode($decode));
        $this->page = $this->argument('page');
        $this->path = $this->argument('path');
        Log::info($this->page);
        dump($this->page);
        dump($this->path);
        $stream = $this->getStream($this->path);
        $reader = Reader::createFromStream($stream);

        if ($this->page == 1) {
            $totalRecords = $reader->count();

            for ($page=0; $page<ceil($totalRecords/self::PER_PAGE); $page++) {
                $path = $this->path;
                $command = "php artisan test $path $page";

                // Spawn the command in the background.
                Artisan::command($command, function () {});
//                exec($command . ' > /dev/null 2>&1 & echo $!');
            }
        } else {
            $records = $this->records($reader, $this->page);
            foreach ($records as $offset => $record) {
                //$offset : represents the record offset
                dump($this->page);
            }
        }
    }

    public function records($reader, $page)
    {
        return (new Statement)
            ->offset($page * self::PER_PAGE)
            ->limit(self::PER_PAGE)
            ->process($reader);
    }

    public function getStream($path)
    {
        $client = new S3Client(array_merge(config('filesystems.disks.s3'), [
            'version' => 'latest'
        ]));
        $client->registerStreamWrapper();
        // Now we can use the s3:// protocol.
        $path = ('s3://' . config('filesystems.disks.s3.bucket') . '/' . $path);
        // Return the stream.
        return fopen($path, 'r', false, stream_context_create([
            's3' => ['seekable' => true]
        ]));
    }
}
