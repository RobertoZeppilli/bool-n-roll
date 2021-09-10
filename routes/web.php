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

// Route::get('/', function () {
//     return view('guests.home');
// });

Auth::routes();


Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function() {

        Route::get('/', 'HomeController@index')->name('welcome');
        Route::resource('musicians', 'MusicianController');

        Route::get('musicians/{id}/sponsor', 'MusicianController@showSponsorPage')->name('musicians.sponsor');
        Route::get('musicians/{id}/messages', 'MusicianController@showMessagePage')->name('musicians.messages');
        Route::get('musicians/{id}/reviews', 'MusicianController@showReviewPage')->name('musicians.reviews');
        Route::get('musicians/{id}/stats', 'StatController@showStats')->name('musicians.stats');
        // Route::get('/payment/make', 'SponsorshipController@make')->name('payment.make');
        // Route::get('/payment', 'SponsorshipController@payment')->name('musicians.payment');
        // Route::post('/checkout', 'SponsorshipController@payment');

        // Route::get('payment', 'SponsorshipController@showSponsorPage')->name('payment.index');

        Route::post('payment/checkout', 'SponsorshipController@payment')->name('paga');
    }); 


Route::get('{any?}', function () {
    return view ('guests.home'); 
})->where('any','.*')->name('home');

