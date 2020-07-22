<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    /*Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');*/
    
    
    Route::get('/', 'PasteController@index');
    Route::get('/pastes', 'PasteController@index');
    Route::get('/pages', 'PasteController@pages');
    Route::get('/find', 'PasteController@find');
    Route::post('/paste', 'PasteController@store');
    //Route::delete('/pastes/{paste}', 'PasteController@destroy');
    Route::get('/{link}', 'PasteController@link_view', function ($link) {
        })->where('link', '[A-Za-z0-9]{8}');
    Route::auth();
    Route::get('/reg', 'Auth\AuthController@getRegister');
    Route::post('/reg', 'Auth\AuthController@postRegister');
    //Route::get('ulogin', 'UloginController@login');
    Route::post('ulogin', 'UloginController@login');    
});
