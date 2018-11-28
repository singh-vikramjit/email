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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/mail_queue', 'MailController@mail_queue')->name('mail_queue');
Route::post('/custom_solution', 'MailController@custom_solution')->name('custom_solution');
Route::post('/mail_command', 'MailController@mail_command')->name('mail_command');
