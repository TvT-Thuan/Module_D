<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CampaingnTicketController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Auth\AuthenticationController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('auth.login');
    Route::post('/', [AuthenticationController::class, 'storeLogin'])->name('auth.store_login');
});
Route::middleware(['auth', 'clearcache'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');
    //Route sử lý campaigns
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::resource('/campaigns', CampaignController::class)->except('destroy');
        Route::prefix('/campaigns')->name('campaigns.')->group(function () {
            //Route sử lý tickets
            Route::get('/{campaign}/tickets/create', [CampaingnTicketController::class, 'create'])->name('tickets.create');
            Route::post('/{campaign}/tickets', [CampaingnTicketController::class, 'store'])->name('tickets.store');
            //Route sử lý sessions
            Route::resource('/{campaign}/sessions', SessionController::class)->except('index', 'show', 'destroy');
            //Route sử lý areas
            Route::get('/{campaign}/areas/create', [AreaController::class, 'create'])->name('areas.create');
            Route::post('/{campaign}/areas', [AreaController::class, 'store'])->name('areas.store');
            //Route sử lý places
            Route::get('/{campaign}/places/create', [PlaceController::class, 'create'])->name('places.create');
            Route::post('/{campaign}/places', [PlaceController::class, 'store'])->name('places.store');
            //Route sử lý reports
            Route::get('/{campaign}/reports', [ReportController::class, 'index'])->name('reports.index');
        });
    });
});
