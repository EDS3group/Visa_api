<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\MatchController;
use App\Http\Controllers\Api\PassportController;
use App\Http\Controllers\Api\ProblemTicketController;
use App\Http\Controllers\Api\RegistrationController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VisaController;
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

// contact us
Route::post('contact-us',[UserController::class,'contactUs']);
Route::get('get-teams',[TeamController::class,'getTeams']);
Route::get('get-teams-paginated',[TeamController::class,'getTeamsPaginated']);

Route::get('all-matches',[TeamController::class,'getAllMatches']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 // country
 Route::get('get-country/{country_id}',[UserController::class,'getCountry']);
 Route::get('get-countries',[UserController::class,'getCountries']);

Route::post('register',[RegistrationController::class,'register'])->name('register');
Route::post('login',[RegistrationController::class,'login'])->name('login');
Route::post('admin-login',[RegistrationController::class,'adminLogin']);


Route::group(['prefix' =>'auth','middleware' =>'auth:sanctum'], function () {

    Route::get('user-requests',[UserController::class,'allRequests']);

    Route::get('get-user',[VisaController::class,'getUser']);

    Route::post('add-visa',[VisaController::class,'addVisa']);
    Route::post('add-visa_information',[VisaController::class,'addVisaInformation']);


    Route::post('add-passport',[PassportController::class,'addPassport']);

    // get requests section
    Route::get('user-visa-requests',[VisaController::class,'visaRequests']);
    Route::get('user-visa-information/{visa_id}',[VisaController::class,'visaInformation']);
    Route::get('user-passport',[PassportController::class,'passportRequest']);
    Route::get('user-school',[UserController::class,'getSchool']);



    // school
    Route::post('add-school',[UserController::class,'addSchool']);


    // make problem ticket
    Route::post('make-ticket',[ProblemTicketController::class,'makeTicket']);

    // reply to problem ticket
    Route::post('user-reply/{problem_ticket_id}',[ProblemTicketController::class,'userReply']);


    // matches
    Route::post('bookMatch',[MatchController::class,'bookMatch']);

});

Route::group(['prefix' =>'admin','middleware' =>'auth:sanctum'], function () {

    // problem tickets
    Route::post('admin-reply/{problem_ticket_id}',[ProblemTicketController::class,'adminReply']);
    Route::get('get-opened-tickets',[ProblemTicketController::class,'getProbemTickets']);
    Route::post('close-ticket/{problem_ticket_id}',[ProblemTicketController::class,'closeTicket']);

    Route::get('get-visas',[VisaController::class,'visas']);
    Route::get('get-visa/{visa_information_id}',[VisaController::class,'visa']);
    Route::get('accept-visa/{visa_id}',[VisaController::class,'acceptVisa']);
    Route::get('reject-visa/{visa_id}',[VisaController::class,'rejectVisa']);

    Route::post('change-visa-status/{visa_id}',[VisaController::class,'changeStatus']);

    Route::get('get-passports',[PassportController::class,'passports']);
    Route::get('get-passport/{passport_id}',[AdminController::class,'passport']);
    Route::get('accept-passport/{passport_id}',[PassportController::class,'acceptPassport']);
    Route::get('reject-passport/{passport_id}',[PassportController::class,'rejectPassport']);

    Route::post('change-passport-status/{passport_id}',[PassportController::class,'changeStatus']);

    // contact us
    Route::get('contact-messages',[AdminController::class,'contactMessage']);
    Route::get('contact-message/{message_id}',[AdminController::class,'message']);


    // countries with his values
    Route::post('add-country-vlue',[AdminController::class,'addCountry']);


    // teams
    Route::post('add-team',[TeamController::class,'addTeam']);
    Route::get('get-teams',[TeamController::class,'getTeams']);
    Route::get('get-teams-paginated',[TeamController::class,'getTeamsPaginated']);

    Route::get('get-team/{team_id}',[TeamController::class,'getTeamById']);
    Route::post('update-team/{team_id}',[TeamController::class,'updateTeam']);
    Route::delete('delete-team/{team_id}',[TeamController::class,'deleteTeam']);


    // matches
    Route::post('make-match/{first_team}/{second_team}',[TeamController::class,'makeMatch']);
    Route::get('all-matches',[TeamController::class,'allMatchesPaginated']);
    Route::get('get-match/{match_id}',[TeamController::class,'getMatchById']);

    // school
    Route::post('change-school-status/{school_id}',[UserController::class,'changeStatus']);

    // match tickets
    Route::get('match-booked-tickets/{match_id}',[MatchController::class,'matchTicketsBooked']);

});


