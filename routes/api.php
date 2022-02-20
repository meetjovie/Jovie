<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/me', [\App\Http\Controllers\UserController::class, 'me']);
Route::put('/profile', [\App\Http\Controllers\UserController::class, 'update']);
Route::delete('/remove-profile-photo', [\App\Http\Controllers\UserController::class, 'removeProfilePhoto']);

Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

//    IMPORT CREATORS
    Route::post('/get-columns-from-csv', [\App\Http\Controllers\Admin\ImportController::class, 'getColumnsFromCsv']);
    Route::post('/import', [\App\Http\Controllers\Admin\ImportController::class, 'import']);

//    USER LISTS
    Route::get('/user-lists', [\App\Http\Controllers\Business\UserListsController::class, 'getLists']);
});
