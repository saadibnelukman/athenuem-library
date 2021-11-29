<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Route::group(['namespace'=>'App\Http\Controllers', 'middleware' =>'is_admin'], function(){
    Route::get('/admin/home','AdminController@admin')->name('admin.home');
    Route::get('/admin/logout','AdminController@logout')->name('admin.logout');

    //member routes
    Route::group(['prefix'=>'members'], function(){
        Route::get('/', 'MemberController@index')->name('member.index');
        Route::post('/store', 'MemberController@store')->name('member.store');
        Route::delete('/delete/{id}', 'MemberController@destroy')->name('member.delete');
        Route::get('/edit/{id}', 'MemberController@edit');
        Route::post('/update', 'MemberController@update')->name('member.update');
    });
    //book routes
    Route::group(['prefix'=>'books'], function(){
        Route::get('/', 'BookController@index')->name('book.index');
        Route::post('/store', 'BookController@store')->name('book.store');
        Route::delete('/delete/{id}', 'BookController@destroy')->name('book.delete');
        Route::get('/edit/{id}', 'BookController@edit');
        Route::post('/update', 'BookController@update')->name('book.update');

        Route::get('/issue', 'BookController@issueBook')->name('book.issue');
        Route::get('/issue/list', 'BookController@issueBookList')->name('book.issue.list');
        Route::post('/issue/store', 'BookController@storeIssuedBook')->name('store.issued.book');

        Route::get('/return', 'BookController@returnBook')->name('book.return');
        Route::post('/return/store', 'BookController@returnBookStore')->name('book.return.store');
    });
});
