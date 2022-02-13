<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('creator', function () {
    dd(\App\Models\Creator::first()->toArray());
});
Route::post('/waitlist', [\App\Http\Controllers\UserController::class, 'addToWaitList']);

Route::get('{any?}', function () {
    return view('welcome');
});
