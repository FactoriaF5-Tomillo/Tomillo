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

Route::get('/students', 'StudentController@getStudents');
Route::get('/students/{student}', 'StudentController@getStudent');
Route::post('/students', 'StudentController@store')->name('student.store');
Route::delete('/students/{student}', 'StudentController@destroy')->name('student.destroy');
Route::patch('/students/{student}', 'StudentController@update')->name('student.update');

Route::get('/teachers', 'TeacherController@getTeachers');
Route::post('/teachers', 'TeacherController@store');
Route::patch('/teachers/{teacher}', 'TeacherController@update');
Route::delete('/teachers/{teacher}', 'TeacherController@destroy');

Route::post('/course/store', 'CourseController@store')->name('course.store');
