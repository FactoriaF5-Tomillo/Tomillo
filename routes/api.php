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
Route::get('/available-students', 'UserController@getAvailableStudents');
Route::get('/students/{user}', 'UserController@getStudent');
Route::post('/students', 'UserController@storeStudent')->name('student.store');
Route::patch('/students/{user}', 'UserController@update')->name('student.update');
Route::delete('/students/{user}', 'UserController@destroy')->name('student.destroy');

Route::post('/students/{user}/checkin', 'UserController@checkIn')->name('student.checkin');
Route::patch('/students/{user}/checkout', 'UserController@checkOut')->name('student.checkout');

Route::get('/teachers', 'UserController@getTeachers');
Route::get('/teachers/{user}', 'UserController@getTeacher');
Route::post('/teachers', 'UserController@storeTeacher')->name('teacher.store');
Route::patch('/teachers/{user}', 'UserController@update')->name('teacher.update');
Route::delete('/teachers/{user}', 'UserController@destroy')->name('teacher.destroy');

Route::get('/courses', 'CourseController@getCourses');
Route::get('/courses/{course}', 'CourseController@getCourse');
Route::post('/courses', 'CourseController@store');
Route::patch('/courses/{course}', 'CourseController@update');
/*Route::middleware('auth:api')->delete('/courses/{course}', 'CourseController@destroy')
    ->name('course.destroy');*/
Route::post('/courses/{course}/addStudentToTheCourse', 'CourseController@addStudentToTheCourse');
Route::post('/courses/{course}/addTeacherToTheCourse', 'CourseController@addTeacherToTheCourse');

Route::get('/justifications', 'JustificationController@getJustifications');
Route::get('/justifications/{justification}', 'JustificationController@getJustification');
Route::post('/justifications', 'JustificationController@store')->name('justification.store');

Route::post('/courses/{course}/statistics', 'CourseController@statistics');
