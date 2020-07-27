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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::get('/students', 'StudentController@index')->name('student.index');

Route::get('/student/create', 'StudentController@create')->name('student.create');
Route::get('/student/{student}', 'StudentController@show')->name('student.show');

Route::get('/student/{student}/edit', 'StudentController@edit')->name('student.edit');

Route::get('/course/create', 'CourseController@create')->name('course.create');





