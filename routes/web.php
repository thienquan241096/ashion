<?php

use App\Http\Controllers\Admin\DemoController;
use App\Http\Controllers\User\UpdateUserController;
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

Route::get('/test',[DemoController::class,'index'])->name('test');

// ADmin

Route::get('/admin', "AdminController@index")->name('admin');

Route::get('/admin/login', "Admin\UserController@getLogin")->name('admin.getLogin');
Route::post('/admin/login', "Admin\UserController@postLogin")->name('admin.postLogin');

Route::get('/admin/logout', "Admin\UserController@postLogout")->name('admin.postLogout');


Route::group(['prefix' => 'admin'], function () {

    Route::get('/profile/{id}', 'Admin\UserController@profile')->name('admin.profile');
    Route::post('profile/{id}', 'Admin\UserController@postEdit')->name('admin.postEditProfile');

    Route::get('/change-password/{id}', 'Admin\UserController@getChangePass')->name('admin.changePassword');
    Route::post('change-password/{id}', 'Admin\UserController@postEdit')->name('admin.postChangePassword');

    Route::group(['prefix' => 'category'], function () {
        Route::get('list', 'Admin\CategoryController@getList')->name('category.getList');

        Route::middleware(['AdminLogin'])->group(function () {
            Route::get('create', 'Admin\CategoryController@getCreate')->name('category.getCreate');
            Route::post('create', 'Admin\CategoryController@postCreate')->name('category.postCreate');

            Route::get('edit/{id}', 'Admin\CategoryController@getEdit')->name('category.getEdit');
            Route::post('edit/{id}', 'Admin\CategoryController@postEdit')->name('category.postEdit');

            Route::get('delete/{id}', 'Admin\CategoryController@getDelete')->name('category.getDelete');
        });
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('list', 'Admin\ProductController@getList')->name('product.getList');

        Route::middleware(['AdminLogin'])->group(function () {
            Route::get('create', 'Admin\ProductController@getCreate')->name('product.getCreate');
            Route::post('create', 'Admin\ProductController@postCreate')->name('product.postCreate');

            Route::get('edit/{id}', 'Admin\ProductController@getEdit')->name('product.getEdit');
            Route::post('edit/{id}', 'Admin\ProductController@postEdit')->name('product.postEdit');

            Route::get('delete/{id}', 'Admin\ProductController@getDelete')->name('product.getDelete');
        });
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('list', 'Admin\UserController@getList')->name('user.getList');

        Route::middleware(['AdminLogin'])->group(function () {
            Route::get('create', 'Admin\UserController@getCreate')->name('user.getCreate');
            Route::post('create', 'Admin\UserController@postCreate')->name('user.postCreate');

            Route::get('edit-profile/{id}', 'Admin\UserController@getEdit')->name('user.getEdit');
            Route::post('edit-profile/{id}', 'Admin\UserController@postEdit')->name('user.postEdit');

            Route::get('edit-password/{id}', 'Admin\UserController@getEditPasword')->name('user.getEditPasword');
            Route::post('edit-password/{id}', 'Admin\UserController@postEditPasword')->name('user.postEditPasword');

            Route::post('delete/{id}', 'Admin\UserController@postDelete')->name('user.postDelete');
        });
    });

    Route::group(['prefix' => 'cart'], function () {
        Route::get('list', 'Admin\CartController@getList')->name('cart.getList');
        Route::get('/detail/{id}', 'Admin\CartController@getDetail')->name('cart.getDetail');
        Route::post('/delete/{id}', 'Admin\CartController@postDelete')->name('cart.postDelete');
    });


    Route::post('/search', "AdminController@postSearch")->name('admin.postSearch');
});

// FONTEND

Route::get('/', "PageController@home")->name('home');
Route::get('/detail/{id}', "PageController@getDetail")->name('getDetail');

Route::get('/shop', "PageController@shop")->name('shop');
Route::get('/contact', "PageController@contact")->name('contact');
Route::get('/blog', "PageController@blog")->name('blog');

Route::get('/cart', "PageController@getCart")->name('getCart');
Route::post('/cart', "PageController@postAddToCart")->name('postAddToCart');
Route::post('/cart/delete/{id}', "PageController@postDeleteProductByID")->name('postDeleteProductByID');

Route::get('/checkout', "PageController@checkOut")->name('checkOut');

Route::get('/login', "PageController@getLogin")->name('getLogin');
Route::post('/login', "PageController@postLogin")->name('postLogin');
Route::get('/register', "PageController@getRegister")->name('getRegister');
Route::post('/register', "PageController@postRegister")->name('postRegister');
Route::post('/logout', "PageController@postLogout")->name('postLogout');


Route::get('/test', 'User\UpdateUserController@tesstChangecurrency')->name('tesstChangecurrency');
