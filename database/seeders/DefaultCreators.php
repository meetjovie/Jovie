<?php

namespace Database\Seeders;

use App\Jobs\InstagramImport;
use Illuminate\Database\Seeder;

class DefaultCreators extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $handlers = [
            'timwhite',
            'therock',
            'taylorswift',
            'cristiano',
            'charlidamelio',
            'mkbhd',
            'ninja',
        ];

        foreach($handlers as $handler){
            InstagramImport::dispatch($handler)->handle();
        }
    }
}
