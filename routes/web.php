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
Route::GET('/test50/{id}','projectControllers@test50')->name('project.test50')->middleware('auth');
Route::GET('/test100/{id}','projectControllers@test100')->name('project.test100')->middleware('auth');
Route::GET('/ChangeBoard/{id}','projectControllers@ChangeBoard')->name('project.ChangeBoard')->middleware('auth');
Route::GET('/CompleteForm/{id}','projectControllers@CompleteForm')->name('project.CompleteForm')->middleware('auth');

Route::post('/Check_Project/info_project','CheckProjectController@show')->middleware('auth');
Route::get('/Check_Project/info_project/{year}/{term}/{file}', 'CheckProjectController@download')->name('download')->middleware('auth');
Route::post('/Check_Project/instructor_project','CheckProjectController@edit')->middleware('auth');
Route::get('/Check_Project/instructor_projectฝSearch/Search','CheckProjectController@Search')->name('action')->middleware('auth');


Route::post('/test50',"projectControllers@wordExport_test50" )->middleware('auth');
Route::post('/test100',"projectControllers@wordExport_test100" )->middleware('auth');
Route::post('/ChangeBoard', "projectControllers@wordExport_ChangeBoard")->middleware('auth');
Route::post('/CompleteForm', "projectControllers@wordExport_CompleteForm")->middleware('auth');
// Route::post('/Check_Project/instructor_project','CheckProjectController@edit')->middleware('auth');