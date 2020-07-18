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
    return view('home.index');
});

Route::get('/teachers', function () {
    return view('home.teacher');
});

Route::get('/admissions', function () {
    return view('home.admissions');
});

Route::get('/about', function () {
    return view('home.about');
});

Route::get('/contact', function () {
    return view('home.contact');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/home', 'HomeController@index');

// Route::post('/filtercourse', 'HomeController@filterthem');

Route::get('/terms', 'TermsController@index')->name('terms');

Route::post('/terms/create', 'TermsController@create');

Route::post('/terms/start', 'TermsController@start');

Route::post('/terms/complete', 'TermsController@complete');

Route::post('/staffs/store', 'UserController@store');

Route::post('/profile/reform', 'UserController@reform');

Route::get('/class', 'ClassController@index')->name('class');

Route::get('/subjects', 'SubjectController@index')->name('subjects');

Route::post('/subjects/create', 'SubjectController@create')->name('subjects.create');

Route::post('/subjects/edit', 'SubjectController@edit');

Route::post('/subjects/delete', 'SubjectController@delete');

Route::get('/classes/create', 'ClassController@create')->name('classes.create');

Route::post('/class/store', 'ClassController@store');

Route::post('/class/assign', 'ClassController@assign');

Route::get('/course', 'CourseController@index')->name('course.index');

Route::post('/course/store', 'CourseController@store');

Route::post('/course/delete', 'CourseController@delete');

Route::post('/course/softdelete', 'CourseController@softdelete');

Route::resource('/course', 'CourseController')->except('index', 'show')->middleware('auth');

Route::get('/course/{course}/edit', 'CourseController@edit')->name('course.edit');

Route::post('/course/{course}/update', 'CourseController@update');

Route::get('/course/{course}', 'CourseController@show')->name('course.show');

Route::get('/lecture/{course}', 'CourseController@startcourse')->name('startcourse');

Route::post('/comment', 'CourseController@comment');

Route::get('/complete/{course}', 'CourseController@complete');

Route::get('/attendance/{course}', 'CourseController@attendance');

Route::get('/user', 'UserController@index')->name('user.index');

Route::get('/student', 'UserController@display')->name('student');

Route::get('/profile', 'UserController@profile')->name('profile');

Route::get('/profile/{user}', 'UserController@userprofile')->name('user.profile');

Route::get('/profile/edit/{user}', 'UserController@editprofile')->name('profile.edit');

Route::post('/student/assign', 'UserController@assign');

Route::get('/student/create', 'UserController@createstudent')->name('students.create');

Route::get('/user/create', 'UserController@create')->name('user.create');

Route::post('/student/store', 'UserController@storestudent');

Route::post('/user/delete', 'UserController@delete');

Route::post('/student/harddelete', 'UserController@harddelete');

Route::get('/user/edit/{staff}', 'UserController@edit');

Route::get('/profile/password', 'UserController@password')->name('profile.password');

Route::post('/changepassword', 'UserController@changepassword');

Route::get('/students', 'UserController@classlist')->name('classlist');

Route::get('/students/{classes}', 'UserController@studetslist')->name('students');

Route::get('/user/{user}/account', 'UserController@account')->name('user.account');






Route::get('/assignment', 'AssignmentController@index')->name('assignment');

// Route::get('/questions', 'AssignmentController@questions')->name('questions');

Route::post('/assignment/store', 'AssignmentController@store');

Route::post('/assignment/create', 'AssignmentController@create');