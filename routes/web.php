<?php

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
});

Route::get('/awstest',function(){

//    $s3 = AWS::createClient('s3');
//    print_r($s3->putObject(array(
//        'Bucket'     => 'jaroapi',
//        'Key'        => 'simu2.jpg',
//        'SourceFile' => 'images/58fec85c80300b0c069a6f3477834330dbcc9628.jpeg',
//    )));




    copy('http://dreamatico.com/data_images/jesus/jesus-5.jpg', 'images/jesus.jpg');

    $fp_image = fopen('images/jesus.jpg', 'r');
    $image = fread($fp_image, filesize('images/jesus.jpg'));
    fclose($fp_image);

    $rekognition = AWS::createClient('rekognition');
    $res = $rekognition->detectLabels([
        'Image' => [
            'Bytes'=>$image
//            'S3Object'=> [
//                'Bucket' => 'jaroapi',
//                'Name' => 'simu.jpg',
//            ]
        ]
    ]);
    print_r($res);


});
