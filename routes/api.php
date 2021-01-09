<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Disbursement;
use App\Http\Controllers\DisbursementController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/disbursement', [DisbursementController::class, 'index']);
Route::get('/disbursement/{disbursement_id}', [DisbursementController::class, 'show']);
Route::post('/disbursement', [DisbursementController::class, 'store']);
Route::put('/disbursement/{disbursement_id}', [DisbursementController::class, 'update']);
Route::delete('/disbursement/{disbursement_id}', [DisbursementController::class, 'delete']);

