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

Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('register', [
    'as' => 'register',
    'uses' => 'Auth\RegisterController@view'
]);

Route::group(['prefix' => 'heroes/', 'as' => 'heroes.', 'middleware' => ['auth']], function () {

    Route::get('/', [
        'as' => 'view',
        'uses' => 'HeroesController@view'
    ]);

    Route::get('create', [
        'as'   => 'createForm',
        'uses' => 'HeroesController@createForm'
    ]);

    Route::post('is-available', [
        'as'   => 'is-available',
        'uses' => 'HeroesController@isHeroNameAvailable'
    ]);

    Route::post('create', [
        'as'   => 'create',
        'uses' => 'HeroesController@create'
    ]);

    Route::get('abilities', [
        'as' => 'abilities',
        'uses' => 'HeroesController@abilities'
    ]);
	
	Route::get('reset-stats', [
		'as' => 'reset-stats',
		'uses' => 'HeroesController@resetStats'
	]);
	
	Route::get('delete/{hero}', [
		'as' => 'delete',
		'uses' => 'HeroesController@deleteHero'
	]);

});
