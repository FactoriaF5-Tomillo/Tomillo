<?php

use App\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Policies\CoursePolicy;
use App\User;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/log-out', 'HomeController@index')->name('log-out');
Route::get('/home', 'HomeController@homeindex')->name('home');

Route::get('/loggeduser', 'UserController@getLoggedUser');

Route::get('/courses', 'CourseController@index')->name('course.index')->middleware('can:viewAny,App\Course');
Route::get('/course/create', 'CourseController@create')->name('course.create')->middleware('can:viewAny,App\Course');
Route::get('/course/{course}', 'CourseController@show')->name('course.show');
Route::get('/course/{course}/edit', 'CourseController@edit')->name('course.edit')->middleware('can:viewAny,App\Course');
Route::get('/course/{course}/assign-studetns', 'CourseController@chooseStudent')->name('course.assign-studetns');
Route::get('/course/{course}/students', 'CourseController@showStudents');
Route::get('/course/{course}/teachers', 'CourseController@showTeachers');
Route::get('/course/{course}/assign-teachers', 'CourseController@showAssignTeacher')->name('course.assign-teachers');


Route::get('/teachers', 'UserController@indexTeacher')->name('teacher.index')->middleware('auth');
Route::get('/teacher/create', 'UserController@createTeacher')->name('teacher.create');
Route::get('/teacher/{user}', 'UserController@showTeacher')->name('teacher.show');
Route::get('/teacher/{user}/edit', 'UserController@editTeacher')->name('teacher.edit');


Route::get('/students', 'UserController@indexStudent')->name('student.index')->middleware('auth');
Route::get('/student/create', 'UserController@createStudent')->name('student.create');
Route::get('/student/{user}', 'UserController@showStudent')->name('student.show');
Route::get('/student/{user}/edit', 'UserController@editStudent')->name('student.edit');


