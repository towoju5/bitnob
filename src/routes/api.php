<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use Towoju5\Bitnob\Http\Controllers\CardsController;

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

// Route::group(['prefix' => 'api'], function(){
//     Route::group(['middleware' => 'auth:sanctum'], function(){
//     // misc
//         Route::post('create',           [CardsController::class, 'create']);
//         Route::post('topup',            [CardsController::class, 'topup']);
//         Route::get('card',              [CardsController::class, 'getCard']);
//         Route::post('card/action',      [CardsController::class, 'action']);
//         Route::get('history/{card_id}', [CardsController::class, 'getTransaction']);
//     });
// });