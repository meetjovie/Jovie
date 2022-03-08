<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are lo aded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    //    PROFILE
    Route::get('/me', [\App\Http\Controllers\UserController::class, 'me']);
    Route::put('/profile', [\App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/remove-profile-photo', [\App\Http\Controllers\UserController::class, 'removeProfilePhoto']);

    Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

//      IMPORT CREATORS
        Route::post('/get-columns-from-csv', [\App\Http\Controllers\ImportController::class, 'getColumnsFromCsv']);
        Route::post('/import', [\App\Http\Controllers\ImportController::class, 'import']);

//      USER LISTS
        Route::get('/user-lists', [\App\Http\Controllers\UserListsController::class, 'getLists']);

//      CRM
        Route::get('/crm-creators', [\App\Http\Controllers\CrmController::class, 'crmCreators']);
        Route::put('/update-creator/{id}', [\App\Http\Controllers\CrmController::class, 'updateCrmCreator']);
        Route::get('/export-crm-creators', [\App\Http\Controllers\CrmController::class, 'exportCrm']);

    });
});
