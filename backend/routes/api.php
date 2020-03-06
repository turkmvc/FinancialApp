<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'ApiAuthController@login');
Route::post('/logout', 'ApiAuthController@logout');
Route::get('/auth-user', 'ApiAuthController@AuthUser');

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('bank-accounts', 'BankAccountController');
    Route::resource('categories', 'CategoryController');
    
    Route::get('transactions/{month}/{year}', 'TransactionController@index');
    Route::resource('transactions', 'TransactionController');
});