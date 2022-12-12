<?php

namespace App\Http\Controllers;

use App\Traits\SocialScrapperTrait;
use Illuminate\Http\Request;

class TestController extends Controller
{
    use SocialScrapperTrait;
    public function test()
    {
        dd(self::scrapTiktok('rabeecak'));
    }
}
