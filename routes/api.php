<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register the API routes for your application as
| the routes are automatically authenticated using the API guard and
| loaded automatically by this application's RouteServiceProvider.
|
*/

//Route::group([
//    'middleware' => 'auth:api'
//], function () {
//
//});


Route::get('/reports')
     ->uses(Api\ReportsController::class . '@show')
     ->middleware('auth:api')
     ->name('api.reports.show');

