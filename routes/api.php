<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/students', 'UserController@getStudents');
Route::get('/students/{user}', 'UserController@getStudent');
Route::post('/students', 'UserController@store')->name('student.store');
Route::patch('/students/{user}', 'UserController@update')->name('student.update');
Route::delete('/students/{user}', 'UserController@destroy')->name('student.destroy');

Route::get('/teachers', 'UserController@getTeachers');
Route::get('/teachers/{user}', 'UserController@getTeacher');
Route::post('/teachers', 'UserController@store')->name('teacher.store');
Route::patch('/teachers/{user}', 'UserController@update')->name('teacher.update');
Route::delete('/teachers/{user}', 'UserController@destroy')->name('teacher.destroy');

Route::get('/courses', 'CourseController@getCourses');
Route::get('/courses/{course}', 'CourseController@getCourse');
Route::post('/courses', 'CourseController@store');
Route::patch('/courses/{course}', 'CourseController@update');
Route::delete('/courses/{course}', 'CourseController@destroy')->name('course.destroy');
Route::post('/courses/{course}/addStudentToTheCourse', 'CourseController@addStudentToTheCourse');
Route::post('/courses/{course}/addTeacherToTheCourse', 'CourseController@addTeacherToTheCourse');
