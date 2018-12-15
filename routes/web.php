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

//Route::get('/', function () {
//
//    $task = [
//        'Contact',
//        'About',
//    ];
////    return view('welcome', [
////        'tasks' => $task
////    ]);
//
////    Similar
////    return view('welcome')->withTasks($task);
//
//
//    return view('welcome')->withTasks($task);
//});

//Similar
Route::get('/', 'LoanController@index');


//Route::get('/Contact', function (){
//    return view('contact');
//});

//Similar
Route::get('/About', 'TestController@about');

//Route::get('/About', function (){
//    return view('about');
//});

//Similar
Route::get('/Contact', 'TestController@contact');


Route::get('/Project', 'ProjectsController@index');
Route::get('/Project/create', 'ProjectsController@create');


Route::post('/Project', 'ProjectsController@store');

//Loan
Route::resource('loan', 'LoanController');
Auth::routes();
