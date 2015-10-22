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
$api->version('v1', function ($api) {
    /*
     * used for Json Web Token Authentication - https://scotch.io/tutorials/token-based-authentication-for-angularjs-and-laravel-apps
     * Make sure to re-enable CSRF middleware if you're disabling JWT
     */
    $api->controller('authenticate', 'App\Http\Controllers\AuthenticateController');

});

# Authenticate using Json Web Token (JWT)
Route::group(['prefix' => 'api/v1/auth'], function () {
    Route::post('login', 'AuthenticateController@postAuth');

    // login
    Route::get('info-login', 'AuthenticateController@getAuth');

    // logout
    Route::get('logout', 'AuthenticateController@deleteAuth');

    // get current token
    Route::get('get-token', 'AuthenticateController@getToken');

});

# Handle Group Books
Route::group(['namespace' => 'Buku', 'prefix' => 'api/v1'], function () {
    // books
    Route::resource('buku', 'BukuController');

    // authors
    Route::resource('penulis', 'PenulisController');

    // publishers
    Route::resource('penerbit', 'PenerbitController');
});

