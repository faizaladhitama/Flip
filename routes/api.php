<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Disbursement;

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

Route::get('disbursement', 'DisbursementController@index');
Route::get('disbursement/{disbursement_id}', 'DisbursementController@show');
Route::post('disbursement', 'DisbursementController@store');
Route::put('disbursement/{disbursement_id}', 'DisbursementController@update');
Route::delete('disbursement/{disbursement_id}', 'DisbursementController@delete');

