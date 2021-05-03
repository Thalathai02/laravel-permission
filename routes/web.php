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
Route::POST('/home','HomeController@search_project')->name('searchHome')->middleware('auth');


Route::resource('/STD', 'ImportExcel\ImportExcelController')->middleware('auth');
Route::resource('/User', 'UserController')->middleware('auth');
Route::resource('/Teacher', 'TeacherController')->middleware('auth');
Route::resource('/system','systemController')->middleware('auth');
Route::resource('/project','projectControllers')->middleware('auth');
Route::resource('/Check_Project','CheckProjectController')->middleware('auth');
Route::resource('/admin','AdminController')->middleware('auth');

Route::GET('/admin/info/{id}', 'AdminController@info_admin')->name('admin.info_admin')->middleware('auth');

Route::resource('/STD/term','subjects')->middleware('auth');
Route::get('/roles', 'PermissionController@Permission');

Route::resource('/STD', 'ImportExcel\ImportExcelController')->middleware('auth');
Route::post('/STD', 'ImportExcel\ImportExcelController@import')->middleware('auth');
Route::get('/STD/info/{id}', 'ImportExcel\ImportExcelController@showinfo')->name('std.showinfo')->middleware('auth');
Route::post('/STD/create', 'ImportExcel\ImportExcelController@store')->middleware('auth');
Route::post('/STD/edit', 'ImportExcel\ImportExcelController@edit')->middleware('auth');
Route::post('/STD/Search','ImportExcel\ImportExcelController@show')->middleware('auth');


Route::post('/User/edit', 'UserController@edit')->middleware('auth');
Route::post('/User/Search', 'UserController@show')->middleware('auth');
    
Route::post('/Teacher/create', 'TeacherController@store')->middleware('auth');
Route::post('/Teacher/edit', 'TeacherController@edit')->middleware('auth');
Route::GET('/Teacher/info/{id}', 'TeacherController@info_tea')->name('Teacher.info_tea')->middleware('auth');

Route::post('/system/index','systemController@show')->middleware('auth');
Route::get('/project/destroy_edit/{id}', 'projectControllers@destroy_edit_name_project')->name('destroy_edit_name_project')->middleware('auth');;

Route::get('/projects/into_project','projectControllers@create')->middleware('auth');
Route::post('/projects/list_name','projectControllers@createNameProject')->middleware('auth');
Route::post('/edit_project','projectControllers@edit')->middleware('auth');
Route::GET('/test50/{id}','projectControllers@test50')->name('project.test50')->middleware('auth');
Route::GET('/test100/{id}','projectControllers@test100')->name('project.test100')->middleware('auth');
Route::GET('/ChangeBoard/{id}','projectControllers@ChangeBoard')->name('project.ChangeBoard')->middleware('auth');
Route::GET('/CompleteForm/{id}','projectControllers@CompleteForm')->name('project.CompleteForm')->middleware('auth');
Route::GET('/ChangeTopic/{id}','projectControllers@ChangeTopic')->name('project.ChangeTopic')->middleware('auth');
Route::GET('/ProgressReport_test50/{id}','projectControllers@ProgressReport_test50')->name('project.ProgressReport_test50')->middleware('auth');
Route::GET('/ProgressReport_test100/{id}','projectControllers@ProgressReport_test100')->name('project.ProgressReport_test100')->middleware('auth');

Route::post('/Check_Project/info_project','CheckProjectController@show')->middleware('auth');
Route::get('/Check_Project/info_project/{year}/{term}/{file}', 'CheckProjectController@download')->name('download')->middleware('auth');
Route::post('/Check_Project/instructor_project','CheckProjectController@edit')->middleware('auth');
Route::get('/Check_Project/instructor_projectSearch/Search','CheckProjectController@Search')->name('action')->middleware('auth');
Route::get('/Selection_yearCheck_Project','CheckProjectController@Selection_year')->name('Selection_year')->middleware('auth');
Route::get('/success_check/{id}','CheckProjectController@success_check')->name('Check_Project.success_check')->middleware('auth');


Route::post('/test50/{id}',"projectControllers@wordExport_test50" )->middleware('auth');
Route::post('/test100/{id}',"projectControllers@wordExport_test100" )->middleware('auth');
Route::post('/ChangeBoard/{id}', "projectControllers@wordExport_ChangeBoard")->middleware('auth');
Route::post('/CompleteForm/{id}', "projectControllers@wordExport_CompleteForm")->middleware('auth');
Route::post('/ChangeTopic/{id}', "projectControllers@wordExport_ChangeTopic")->middleware('auth');
Route::post('/ProgressReport_test50/{id}', "projectControllers@wordExport_ProgressReport_test50")->middleware('auth');
Route::post('/ProgressReport_test100/{id}', "projectControllers@wordExport_ProgressReport_test100")->middleware('auth');
Route::post('/reject_project/{id_Notifications}/{id}/{id_test}', "projectControllers@reject_project")->name('project.reject_project')->middleware('auth');
Route::get('/reject_allow/{id}/{id_test}','projectControllers@reject_allow' )->name('project.reject_allow')->middleware('auth');

Route::post('/notification', "projectControllers@notification")->middleware('auth');

Route::get('/checkForm/{form}/{formId}/{id_Notifications}', "InfoWordTemplateController@checkForm")->name('InfoWordTemplate.checkForm')->middleware('auth');
Route::get('/{form}/{status}/{file}', 'InfoWordTemplateController@download')->name('InfoWordTemplate.download')->middleware('auth');
Route::get('/markAsRead/{id}', 'InfoWordTemplateController@markAsRead')->name('InfoWordTemplate.markAsRead')->middleware('auth');
Route::resource('/notification/index','notification')->middleware('auth');

Route::post('/edit_project/{id}',"projectControllers@edit_project" )->middleware('auth');
Route::GET('/info_project/{id}','projectControllers@info_project')->name('info_project')->middleware('auth');
Route::get('/Showinfo_project/{id}', 'CheckProjectController@info_project')->name('CheckProject.info_project')->middleware('auth');

Route::GET('/president','projectControllers@president_page')->name('president_page')->middleware('auth');
Route::Post('/president','projectControllers@president_show')->middleware('auth');
Route::GET('/director','projectControllers@director_page')->name('director_page')->middleware('auth');
Route::Post('/director','projectControllers@director_show')->middleware('auth');

Route::GET('/comment_test50','projectControllers@comment_test50_page')->middleware('auth');
Route::GET('/comment_test50/{id}','projectControllers@comment_test50')->name('comment_test50_id')->middleware('auth');
Route::post('/comment_test50/{id}','projectControllers@comment_test50_Datas')->name('comment_test50_Datas')->middleware('auth');
Route::GET('/allResultsTest50/{id}','projectControllers@ResultsTest50')->name('ResultsTest50')->middleware('auth');
Route::get('/allowCommentTest50/{id1}/{id2}/{id3}','projectControllers@remove_comment_test50')->name('remove_comment_test50')->middleware('auth');

Route::GET('/comment_test100','projectControllers@comment_test100_page')->middleware('auth');
Route::GET('/comment_test100/{id}','projectControllers@comment_test100')->name('comment_test100_id')->middleware('auth');
Route::post('/comment_test100/{id}','projectControllers@comment_test100_Datas')->name('comment_test100_Datas')->middleware('auth');
Route::GET('/allResultsTest100/{id}','projectControllers@ResultsTest100')->name('ResultsTest100')->middleware('auth');
Route::get('/allowCommentTest100/{id1}/{id2}/{id3}','projectControllers@remove_comment_test100')->name('remove_comment_test100')->middleware('auth');

Route::GET('/CollectPoints','projectControllers@CollectPoints')->name('projectControllers.CollectPoints')->middleware('auth');
Route::GET('/CollectPoints/{id}','projectControllers@CollectPointsForm')->name('projectControllers.collectPointsForm')->middleware('auth');

Route::POST('/CollectPoints/{id}','projectControllers@wordExport_CollectPoints')->name('projectControllers.wordExport_CollectPoints')->middleware('auth');
Route::get('/allreject/{id}', 'CheckProjectController@allreject')->name('CheckProject.allreject')->middleware('auth');

Route::get('/SendGrade', 'CheckProjectController@SendGrade_page')->name('CheckProject.SendGrade_page')->middleware('auth');
Route::POST ('/SendGradeReport', 'CheckProjectController@SendGrade')->name('CheckProject.SendGrade')->middleware('auth');
Route::GET('/public_project', 'PublicProjectController@public_project')->name('PublicProject.public_project')->middleware('auth');
Route::POST('/search_public_projec', 'PublicProjectController@search_public_projec')->name('PublicProject.search_public_projec')->middleware('auth');
Route::GET('/public_project/{id}', 'PublicProjectController@view_public_projec')->name('PublicProject.view_public_projec');
Route::GET('/edit_public_projec/{id}', 'PublicProjectController@edit_public_projec')->name('PublicProject.edit_public_projec')->middleware('auth');
Route::POST('/store_public_projec/{id}', 'PublicProjectController@store')->name('PublicProject.store')->middleware('auth');

Route::get('/{form}/{file}', 'PublicProjectController@download')->name('PublicProject.download');
Route::POST('/search', 'PublicProjectController@search_Guest_public_projec')->name('PublicProject.search_Guest_public_projec');



// Route::get('/001','data\DataTableController@Calculation');
// Route::Post('/infotest50/{id}', "/InfoWordTemplateController@test50")->middleware('auth');
// Route::post('/Check_Project/instructor_project','CheckProjectController@edit')->middleware('auth');



