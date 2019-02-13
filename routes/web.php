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

Route::get('/cache', function() { $exitCode = Artisan::call('cache:clear'); $exitCode = Artisan::call('cache:clear'); $exitCode = Artisan::call('cache:clear'); return 'DONE'; //Return anything 
});
Route::get('/config', function() { $exitCode = Artisan::call('config:cache'); $exitCode = Artisan::call('config:cache'); $exitCode = Artisan::call('config:cache'); return 'DONE'; //Return anything 
});

/***********************Front-Section****************************/

Route::get('/','HomeController@index');
Route::get('aboutus','HomeController@aboutUs');
Route::post('contactussubmission','HomeController@contactUs');
Route::post('subscribe', 'HomeController@Subscribe');

/***********************Admin-Section****************************/

Route::get('admin/login','Admin\LoginController@login');
Route::post('admin/login','Admin\LoginController@authentication');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin','middleware'=>'admin'],function(){
	Route::get('home','LoginController@home');
	Route::get('logout',function(){
		\Auth::logout();
          return redirect('admin/login');
	});
/***********************Categories-Section****************************/

Route::resource('categories', 'CategoryController');
	Route::group(['prefix' => 'categories'],function(){
		Route::post('/status', 'CategoryController@changeStatus');
	});

/***********************Plot-Section****************************/

Route::resource('plot', 'PlotController');
	Route::group(['prefix' => 'plot'],function(){
		Route::post('/status', 'PlotController@changeStatus');
	});

/***********************Sliders-Section****************************/

Route::resource('sliders', 'SliderController');
	Route::group(['prefix' => 'sliders'],function(){
		Route::post('/status', 'SliderController@changeStatus');
	});

/***********************Testimonials-Section****************************/

Route::resource('testimonial', 'TestimonialController');
	Route::group(['prefix' => 'testimonial'],function(){
		Route::post('/status', 'TestimonialController@changeStatus');
	});

/***********************Social Media-Section****************************/
Route::resource('social', 'SocialMediaController');
});