<?php

use App\Http\Controllers\Api\v1\ApiAuthenticationController;
use App\Http\Controllers\Api\v1\ApiCampaignController;
use App\Http\Controllers\Api\v1\ApiRegistrationController;
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

Route::prefix("v1")->group(function () {
    Route::post('login', [ApiAuthenticationController::class, 'login']);
    Route::post('logout', [ApiAuthenticationController::class, 'logout']);
    Route::get('campaigns', [ApiCampaignController::class, 'index']);
    Route::get('organizers/{organizer_slug}/campaigns/{campaign_slug}', [ApiCampaignController::class, 'show']);
    Route::post('organizers/{organizer_slug}/campaigns/{campaign_slug}/registration', [ApiRegistrationController::class, 'create']);
    Route::get('registrations', [ApiRegistrationController::class, 'show']);
});

