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


Route::get('/courses', 'CourseController@index')->name('course.index');

Route::get('/course/create', 'CourseController@create')->name('course.create');

Route::get('/course/{course}', 'CourseController@show')->name('course.show');

Route::get('/course/{course}/edit', 'CourseController@edit')->name('course.edit');

Route::get('/course/{course}/chooseStudent', 'CourseController@chooseStudent')->name('course.chooseStudent');

Route::get('/teachers', 'TeacherController@index')->name('teacher.index');

Route::get('/teacher/create', 'TeacherController@create')->name('teacher.create');

Route::get('/teacher/{teacher}', 'TeacherController@show')->name('teacher.show');

Route::get('/teacher/{teacher}/edit', 'TeacherController@edit')->name('teacher.edit');

Route::get('/course/{course}/showAssignTeacher', 'CourseController@showAssignTeacher')->name('course.showAssignTeacher');
