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
Route::post('register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout']);
Route::post('validate-step-1', [\App\Http\Controllers\Auth\AuthController::class, 'validateStep1']);

Route::group(['middleware' => ['auth:sanctum']], function () {

        //    PROFILE
        Route::get('/me', [\App\Http\Controllers\UserController::class, 'me']);
        Route::put('/profile', [\App\Http\Controllers\UserController::class, 'update']);
        Route::delete('/remove-profile-photo', [\App\Http\Controllers\UserController::class, 'removeProfilePhoto']);

        //IMPORT CREATORS
        Route::post('/get-columns-from-csv', [\App\Http\Controllers\ImportController::class, 'getColumnsFromCsv']);
        Route::post('/import', [\App\Http\Controllers\ImportController::class, 'import']);

        //      USER LISTS
        Route::get('/user-lists', [\App\Http\Controllers\UserListsController::class, 'getLists']);

        //      CRM
        Route::get('/crm-creators', [\App\Http\Controllers\CrmController::class, 'crmCreators']);
        Route::put('/update-creator/{id}', [\App\Http\Controllers\CrmController::class, 'updateCrmCreator']);
        Route::get('/export-crm-creators', [\App\Http\Controllers\CrmController::class, 'exportCrm']);

        //      OVERVIEW
        Route::get('/creators-overview/{id}', [\App\Http\Controllers\CrmController::class, 'overview']);
        Route::post('/add-comment', [\App\Http\Controllers\CrmController::class, 'addComment']);
        Route::get('/get-comments/{id}', [\App\Http\Controllers\CrmController::class, 'getComments']);
        Route::put('/update-overview-creator/{id}', [\App\Http\Controllers\CrmController::class, 'updateOverviewCreator']);

        Route::get('/next-creator/{id}', [\App\Http\Controllers\CrmController::class, 'nextCreator']);
        Route::get('/previous-creator/{id}', [\App\Http\Controllers\CrmController::class, 'previousCreator']);

        Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

                //     
        });

        /**
         * Teamwork routes
         */
        Route::group(['prefix' => 'teams', 'namespace' => 'Teamwork'], function()
        {
        Route::get('/', [App\Http\Controllers\Teamwork\TeamController::class, 'index'])->name('teams.index');
        Route::post('teams', [App\Http\Controllers\Teamwork\TeamController::class, 'store'])->name('teams.store');
        Route::get('team/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'edit'])->name('teams.edit');
        Route::put('update/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'update'])->name('teams.update');
        Route::delete('destroy/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'destroy'])->name('teams.destroy');
        Route::get('switch/{id}', [App\Http\Controllers\Teamwork\TeamController::class, 'switchTeam'])->name('teams.switch');

        Route::get('members/{id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'show'])->name('teams.members.show');
        Route::get('members/resend/{invite_id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'resendInvite'])->name('teams.members.resend_invite');
        Route::post('members/{id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'invite'])->name('teams.members.invite');
        Route::delete('members/{id}/{user_id}', [App\Http\Controllers\Teamwork\TeamMemberController::class, 'destroy'])->name('teams.members.destroy');

        Route::get('accept/{token}', [App\Http\Controllers\Teamwork\AuthController::class, 'acceptInvite'])->name('teams.accept_invite');
        });
});
