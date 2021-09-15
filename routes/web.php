<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use Symfony\Component\HttpFoundation\Request;

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
    return view('guests.home');
});

Auth::routes();


Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {

        Route::get('/', 'HomeController@index')->name('welcome');
        Route::resource('/musicians', 'MusicianController');

        Route::get('/musicians/{slug}/sponsor', 'MusicianController@showSponsorPage')->name('musicians.sponsor');
        Route::get('/musicians/{slug}/messages', 'MusicianController@showMessagePage')->name('musicians.messages');
        Route::get('/musicians/{slug}/reviews', 'MusicianController@showReviewPage')->name('musicians.reviews');
        Route::get('/musicians/{slug}/stats', 'StatController@showStats')->name('musicians.stats');

        Route::post('payment/checkout', 'SponsorshipController@payment')->name('paga');

       
    }); 


Route::get('{any?}', 'HomeController@index')->where('any', '.*');

