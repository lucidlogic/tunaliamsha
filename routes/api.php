<?php

use Illuminate\Http\Request;

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

Route::get('/test')
     ->uses(Api\ApiToneController::class . '@show')
     ->name('api.tone.show');

Route::get('/awstest',function(){
    $s3 = App::make('aws')->createClient('s3');
    print_r($s3->putObject(array(
        'Bucket'     => 'jaroapi',
        'Key'        => 'image-name',
        'SourceFile' => 'images/bibi.jpg',
    )));


});
