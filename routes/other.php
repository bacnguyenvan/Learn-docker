<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;



Route::get('/elevation/{lat}/{long}', function ($lat = 36.103543, $long = 140.08531) {
    
    try{
        $url = config('api.map.elevation_base_url_php')."?lon=$long&lat=$lat&outtype=JSON";

        $data = json_decode(file_get_contents($url), true);
        
        return $data['elevation'];
        

    }catch(\Exception $err){
        throw $err;
    }
});


Route::get('/tt', function () {
    $contents = file_get_contents("https://logos-download.com/wp-content/uploads/2016/09/Laravel_logo.png");
    Storage::disk('route_data')->put('1/demo.png', $contents);
    return "OK";
});

Route::get('/getPassword/{pass}', function ($pass) {
    dd(bcrypt($pass));
});


Route::get('/', function () {
    return response()->json([
        'status_code' => 200,
        'message' => 'API Connected',
        'laravel_version' => app()->version(),
    ], 200);
})->name('api.welcome');

Route::fallback(function () {
    return response()->json([
        'status_code' => 404,
        'message' => 'Page Not Found'
    ], 404);
})->name('api.fallback.404');

Route::get('/test', function () {
    try {
        throw new \App\Exceptions\MontBellTokenNotValidException;
    } catch (\Exception $e) {
        throw $e;
    }
})->name('api.tea');

