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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::any('/wechat', 'WechatController@serve');
Route::any('/demo', 'WechatController@demo');

Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::get('/user', 'WechatController@user');
    Route::get('/ticket', 'WechatController@ticket');

});
Route::any('/join', 'ActiveController@join');
Route::any('/join_users', 'ActiveController@joinUsers');
Route::any('/help', 'ActiveController@help');
Route::any('/help_person', 'ActiveController@helpPerson');
