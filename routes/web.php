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
//Route::group(['middleware' => 'auth'], function () {
//    Route::get('/dashboard', function () {
//        return view('backend.includes.layout');
//    })->name('dashboard');
//});

Route::get('/','Frontend\HomeController@home')->name('home');
Route::get('/about','Frontend\HomeController@about')->name('about');

Route::get('/services','Frontend\HomeController@services')->name('services');
Route::get('/service/{slug}','Frontend\HomeController@service')->name('service');
Route::post('/service-review/{id}','Frontend\HomeController@serviceReview')->name('service-review');

Route::get('/projects','Frontend\HomeController@projects')->name('projects');
Route::get('/project/{slug}','Frontend\HomeController@project')->name('project');

Route::get('/contact','Frontend\HomeController@contact')->name('contact');
Route::post('/send-mail','Frontend\HomeController@getMail')->name('send-mail');


Route::get('/register','Authentication\AuthController@register')->name('register');
Route::post('/register-user','Authentication\AuthController@registerUser')->name('register-user');
Route::get('/login','Authentication\AuthController@login')->name('login');
Route::post('/login-user','Authentication\AuthController@loginUser')->name('login-user');
Route::get('/logout','Authentication\AuthController@logout')->name('logout');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard.dashboard');
    })->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::resource('user','User\UserController');
        Route::resource('about','About\AboutController');
        Route::resource('slider','Slider\SliderController');
        Route::resource('service','Service\ServiceController');
        Route::resource('project','Project\ProjectController');
        Route::resource('contact','Contact\ContactController');
        Route::resource('team','Team\TeamController');
        Route::resource('testimonial','Testimonial\TestimonialController');
        Route::resource('query','Query\QueryController');
    });
});

