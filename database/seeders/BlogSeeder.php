<?php
 
namespace Database\Seeders;

use Faker\Core\Number;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
 
class BlogSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_posts')->insert([
            
            'title' => Str::random(10),
            'excerpt' => Str::random(10),
            'author' => Str::random(10),
            'slug' => Str::random(10),
            'category' => Str::random(10),
        
            'body' => Str::random(10),
         


        ]);
    }
}