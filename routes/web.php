<?php

use App\Providers\RouteServiceProvider;
use App\Role;
use App\subject;
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
Route::get('/nameStd', function () {
    return view('STD');
});

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/STD', 'ImportExcel\ImportExcelController')->middleware('auth');
Route::resource('/User', 'UserController')->middleware('auth');
Route::resource('/Teacher', 'TeacherController')->middleware('auth');
Route::resource('/system','systemController')->middleware('auth');
Route::resource('/project','projectControllers')->middleware('auth');
Route::resource('/Check_Project','CheckProjectController')->middleware('auth');

Route::resource('/STD/term','subjects')->middleware('auth');
Route::get('/roles', 'PermissionController@Permission');

    Route::resource('/STD', 'ImportExcel\ImportExcelController')->middleware('auth');
    Route::post('/STD', 'ImportExcel\ImportExcelController@import')->middleware('auth');
    Route::post('/STD/create', 'ImportExcel\ImportExcelController@store')->middleware('auth');
Route::post('/STD/edit', 'ImportExcel\ImportExcelController@edit')->middleware('auth');
Route::post('/STD/Search','ImportExcel\ImportExcelController@Search')->middleware('auth');


Route::post('/User/edit', 'UserController@edit')->middleware('auth');
Route::post('/User/Search', 'UserController@Search')->middleware('auth');
    
Route::post('/Teacher/create', 'TeacherController@store')->middleware('auth');
Route::post('/Teacher/edit', 'TeacherController@edit')->middleware('auth');

Route::post('/system/index','systemController@show')->middleware('auth');

Route::get('/projects/into_project','projectControllers@create')->middleware('auth');
Route::post('/projects/list_name','projectControllers@createNameProject')->middleware('auth');
Route::post('/edit_project','projectControllers@edit')->middleware('auth');

Route::post('/Check_Project/info_project','CheckProjectController@show')->middleware('auth');
Route::get('/Check_Project/info_project/{file}', 'CheckProjectController@download')->name('download')->middleware('auth');
Route::post('/Check_Project/instructor_project','CheckProjectController@edit')->middleware('auth');
// Route::post('/Check_Project/instructor_project','CheckProjectController@edit')->middleware('auth');