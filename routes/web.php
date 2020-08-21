<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/nameStd',function(){
    return view('STD');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/STD','ImportExcel\ImportExcelController')->middleware('auth');

Route::get('/roles', 'PermissionController@Permission');

Route::group(['middleware' => 'role:Admin'], function() {
    Route::resource('/STD','ImportExcel\ImportExcelController')->middleware('auth');
    Route::post('/STD', 'ImportExcel\ImportExcelController@import')->middleware('auth');
    Route::post('/STD/create', 'ImportExcel\ImportExcelController@store')->middleware('auth');
    Route::post('/STD/edit', 'ImportExcel\ImportExcelController@edit')->middleware('auth');
    Route::get('/admin', function() {
       return 'Welcome Admin';
       
    });
 
 });


