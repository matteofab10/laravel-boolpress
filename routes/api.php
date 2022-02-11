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

Route::get('prova', function(){
    
    $status = 'Ok';
    
    $user = [
        "name"=>"Ugo",
        "lastname"=>"De Ughi",
        "hobbies" => [
            'golf',
            'curling',
            'bocce'
        ]
    ];
    
    return response()->json(compact('status','user'));
});


// Route::get('posts', 'Api\PostController@index');
// Route::get('{slug}', 'Api\PostController@show');

Route::namespace('Api')
    ->prefix('posts')
    ->group(function(){
        Route::get('/', 'PostController@index');
        Route::get('{slug}', 'PostController@show');
    });
