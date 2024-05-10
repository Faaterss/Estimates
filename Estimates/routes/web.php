<?php

use Illuminate\Support\Facades\Route;
use Modules\Estimates\App\Http\Controllers\EstimatesController;

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

Route::group([], function () {
    Route::get('/estimates', [EstimatesController::class, 'list']);
    Route::post('/estimates', [EstimatesController::class, 'ajax']);
    
    Route::get('/estimates/profile/{id}/{tab?}/', [EstimatesController::class, 'profile']);
    Route::post('/estimates/profile/{id}/{tab?}/', [EstimatesController::class, 'ajax']);
});
