<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use pcrov\JsonReader\JsonReader;

class ImportTiktok implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
//        try {
        $reader = new JsonReader();
        $reader->open('https://a7x3storage.s3.amazonaws.com/data/tiktok.json');
        $reader->read(); // First element, or end of array
            $reader->read(); // First object
            while ($reader->type() === JsonReader::OBJECT) {
                $object = $reader->value();
                dd($object);
                $creator = new Creator();
                $creator->target_id = $object['id'] ?? '-';
                $creator->name = $object['name'] ?? '-';
                $creator->gender = $object['gender'] ?? 'unknown';
                $creator->type = $object['__typename'] ?? 'unknown';
                $creator->status = $object['status'] ?? '-';
                $creator->save();
                $reader->next();
            }
//            $creators = json_decode(file_get_contents('https://creatorconnect001.s3.amazonaws.com/influencers-live.json'));
//            $progress = $this->output->createProgressBar(count($creators));
//            $progress->start();
//            foreach ($creators as $record) {
//                $creator = new Contact();
//                $creator->target_id = $record->id ?? '-';
//                $creator->name = $record->name ?? '-';
//                $creator->gender = $record->gender ?? 'unknown';
//                $creator->type = $record->__typename ?? 'unknown';
//                $creator->status = $record->status ?? '-';
//                $creator->save();
//                $progress->advance();
//            }
//            $progress->finish();
//        } catch (\Exception $e) {
//            dd($e->getMessage());
//        }
    }
}
