<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'AngularController@serveApp');

Route::get('/unsupported-browser', 'AngularController@unsupported');

$api = app('Dingo\Api\Routing\Router');

# Handle authenticate
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers', 'prefix' => 'auth'], function ($api) {
        // login
        $api->post('login', 'AuthenticateController@postAuth');

        // info current user login
        $api->get('info-login', 'AuthenticateController@getAuth');

        // logout
        $api->get('logout', 'AuthenticateController@deleteAuth');
    });
});

# Handle books
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Buku'], function ($api) {
        // books
        $api->resource('buku', 'BukuController');
        // authors
        $api->resource('penulis', 'PenulisController');
        // publishers
        $api->resource('penerbit', 'PenerbitController');
        // categories
        $api->resource('kategori', 'KategoriController');
    });
});

