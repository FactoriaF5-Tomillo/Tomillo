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
Route::post('/students/{user}/checkin', 'UserController@checkIn')->name('student.checkin');
Route::patch('/students/{user}/checkout', 'UserController@checkOut')->name('student.checkout');

Route::get('/teachers', 'UserController@getTeachers');
Route::get('/teachers/{user}', 'UserController@getTeacher');

Route::get('/courses', 'CourseController@getCourses');
Route::get('/courses/{course}', 'CourseController@getCourse');
//Route::get('/courses/{course}/days', 'CourseController@getCourseDays');

/*Route::middleware('auth:api')->delete('/courses/{course}', 'CourseController@destroy')
    ->name('course.destroy');*/


Route::get('/justifications', 'JustificationController@getJustifications');
Route::get('/justifications/{justification}', 'JustificationController@getJustification');
Route::post('/justifications', 'JustificationController@store')->name('justification.store');
Route::get('/justification/{justification}/approve', 'JustificationController@approveJustification');
Route::post('/courses/{course}/statistics', 'CourseController@statistics');
