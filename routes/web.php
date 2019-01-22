<?php

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

Route::get('/', function () {
    return view('UploadFile');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/mail_queue', 'MailController@mail_queue')->name('mail_queue');
Route::post('/custom_solution', 'MailController@custom_solution')->name('custom_solution');
Route::post('/mail_command', 'MailController@mail_command')->name('mail_command');
Route::get('/send_custom_mail', 'MailController@send_custom_mail')->name('send_custom_mail');
Route::post('/mail_dispatch', 'MailController@mail_dispatch')->name('mail_dispatch');

Route::match(['get','post'],'/uploadFile', 'UploadMediaController@uploadFile')->name('uploadFile');


Route::match(['get','post'],'/testing', 'HomeController@testMethod')->name('testing');


/*
|-----------------------------------------------------
| Admin Routes
|------------------------------------------------------
*/

Route::prefix('admin')->group(function() {
	Route::match(['get','post'],'/', 'AdminController@admin_login')->middleware('guest.admin')->name('admin');
	Route::match(['get','post'],'/login', 'AdminController@admin_login')->middleware('guest.admin')->name('admin.login');
	Route::get('/logout','AdminController@admin_logout')->middleware('auth:admin')->name('admin.logout');
	
	Route::match(['get','post'],'/dashboard', 'AdminController@admin_dashboard')->middleware('auth:admin')->name('admin.dashboard');
	Route::get('/users', 'AdminController@admin_users')->middleware('auth:admin')->name('admin.users');

});


Route::get('db', 'DbStatsController@runDatabaseQueries');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
