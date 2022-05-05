<?php

use App\Http\Controllers\CandidateController;
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

Route::get('/', function () {
    return view('homepage');
});

Route::prefix('candidate')
    ->controller(CandidateController::class)
    ->group(function () {
        Route::get('list', 'index');
        Route::post('contact/{candidate}', 'contact');
        Route::post('hire/{candidate}', 'hire');
    });
