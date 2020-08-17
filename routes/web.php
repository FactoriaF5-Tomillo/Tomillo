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




Route::get('/students', 'UserController@index')->name('student.index');
Route::get('/student/create', 'UserController@create')->name('student.create');
Route::get('/student/{student}', 'UserController@show')->name('student.show');
Route::get('/student/{student}/edit', 'UserController@edit')->name('student.edit');


Route::get('/courses', 'CourseController@index')->name('course.index');
Route::get('/course/create', 'CourseController@create')->name('course.create');
Route::get('/course/{course}', 'CourseController@show')->name('course.show');
Route::get('/course/{course}/edit', 'CourseController@edit')->name('course.edit');
Route::get('/course/{course}/assign-studetns', 'CourseController@chooseStudent')->name('course.assign-studetns');
Route::get('/course/{course}/students', 'CourseController@showStudents');
Route::get('/course/{course}/teachers', 'CourseController@showTeachers');
Route::get('/course/{course}/assign-teachers', 'CourseController@showAssignTeacher')->name('course.assign-teachers');


Route::get('/teachers', 'UserController@index')->name('teacher.index');
Route::get('/teacher/create', 'UserController@create')->name('teacher.create');
Route::get('/teacher/{teacher}', 'UserController@show')->name('teacher.show');
Route::get('/teacher/{teacher}/edit', 'UserController@edit')->name('teacher.edit');
