<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AnalyticMiddleware;


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

Route::middleware([AnalyticMiddleware::class])->group(function () {
    Route::get('/analytics', 'AnalyticsController@index')->name('analytics');

    Route::redirect('/', '/new-note')->name('home');


    Route::get('/new-note', 'MainController@index');
    Route::post('/new-note', 'MainController@create')->name('note.create');

    Route::get('/note/{slug}', 'MainController@show')->name('note.display');
    Route::post('/note/{slug}', 'MainController@decrypt')->name('note.decrypt');



    Route::fallback(function () {
        return redirect()->route('home');
    });
});