<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::get('/', 'HomeController@index')->name('home');
    
    Route::get('/home', 'HomeController@index')->name('home');

    /**
     * Rotas para o vue-routes
     */
    Route::get('/{any}', 'NotaFiscalController@index')->where('any', '.*');
});
