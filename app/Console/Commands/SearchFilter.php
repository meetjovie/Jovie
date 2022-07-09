<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use MeiliSearch\Client;

class SearchFilter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'search:filter';

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
        $client = new Client(config('scout.meilisearch.host'), config('scout.meilisearch.key'));
        $response = $client->index('creators')->updateFilterableAttributes([
            'id',
            'instagram_followers',
            'instagram_engagement_rate',
            'engaged_follows',
            'gender',
            'city',
            'country',
            'instagram_category',
            'emails',
            'has_emails',
            'tags',
            'all_to',
            'selected_to',
            'rejected_to',
            'unique',
        ]);
        $this->info('The command was successful!'.json_encode($response));
    }
}
