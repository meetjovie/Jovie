<?php

namespace App\Jobs;

use App\Events\ImportListCreated;
use App\Imports\ImportFileImport;
use App\Models\Import;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserList;
use Aws\S3\S3Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Maatwebsite\Excel\Facades\Excel;
use PharIo\Version\Exception;

class SaveImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;

    private $mappedColumns;

    private $tags;

    private $listName;

    private $userId;

    private $teamId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $mappedColumns, $tags, $listName, $userId, $teamId)
    {
        $this->file = $file;
        $this->mappedColumns = $mappedColumns;
        $this->tags = $tags;
        $this->listName = $listName;
        $this->userId = $userId;
        $this->teamId = $teamId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::where('id', $this->userId)->increment('queued_count');

        try {
            $stream = Import::getStream($this->file);
            $reader = Reader::createFromStream($stream);

            $totalRecords = $reader->count();
            $list = UserList::firstOrCreateList($this->userId, $this->listName, $this->teamId);
            if ($list->wasRecentlyCreated) {
                ImportListCreated::dispatch($this->teamId, $list);
            }
            $payload = base64_encode(json_encode([
                'mappedColumns' => $this->mappedColumns,
                'tags' => $this->tags,
                'list' => $list,
                'userId' => $this->userId,
                'teamId' => $this->teamId,
            ]));
            for ($page = 0; $page < ceil($totalRecords / Import::PER_PAGE); $page++) {
                $command = "save:import-chunk $this->file $page $payload";
                // Spawn the command in the background.
                Artisan::queue($command);
            }
            Notification::createNotification("$list->name import queued. It will begin shortly.", Notification::IMPORT_QUEUED, $this->userId, $this->teamId);
        } catch (\Exception $e) {
            SendSlackNotification::dispatch(('Error saving file for user '.$this->userId.' - team '.$this->teamId.' for file '.$this->file), ('Error on Save Import '.$e->getMessage().'----'.$e->getFile().'-----'.$e->getLine()), [
                'file' => $this->file,
                'mappedColumns' => $this->mappedColumns,
                'tags' => $this->tags,
                'list' => $this->listName,
                'userId' => $this->userId,
                'teamId' => $this->teamId,
            ]);
        } finally {
            User::where('id', $this->userId)->decrement('queued_count');
        }
    }
}
