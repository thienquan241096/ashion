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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', 'ApiController@apiProductByCartID')->name('api.productByCartId');

Route::get('/listProd', 'ApiController@apiListProd')->name('api.ListProd');

Route::get('/count', 'ApiController@apiCountPrd')->name('api.CountPrd');

Route::get('/addToCart', 'ApiController@apiAddToCart')->name('api.addToCart');

Route::post('/search', 'ApiController@postSearch')->name('api.postSearch');

Route::get('/searchCate', 'ApiAdminController@getSearchCate');

Route::get('/searchProd', 'ApiAdminController@getSearchProd');

Route::get('/searchUser', 'ApiAdminController@getSearchUser');