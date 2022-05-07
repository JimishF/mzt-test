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
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\WalletController;

Route::prefix('candidate')
    ->controller(CandidateController::class)
    ->group(function () {
        Route::get('list', 'index');
        Route::post('contact/{candidate}', 'contact');
        Route::post('hire/{candidate}', 'hire');
    });

Route::get('wallet', [WalletController::class, 'show']);