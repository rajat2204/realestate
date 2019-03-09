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
Route::post('subscribe', 'HomeController@Subscribe');
Route::get('featuredproperty', 'HomeController@featuredProperty');
Route::get('services', 'HomeController@allServices');
Route::get('properties/{slug}','HomeController@singlePlotView');
Route::post('remarkablework','HomeController@remarkableWork');
Route::get('properties','HomeController@allProperties');
Route::get('projects','HomeController@allProjects');
Route::get('testimonials','HomeController@testimonials');
Route::get('contact','HomeController@contact');
Route::post('contactussubmission','HomeController@contactUs');
Route::get('sliders/{slug}','HomeController@enquiry');
Route::post('enquirysubmission','HomeController@enquirySubmission');
Route::get('search-properties','HomeController@propertyFinder');
Route::post('signup','HomeController@signUp');
Route::post('login','HomeController@customerLogin');
Route::post('search/property','HomeController@searchProperty');
Route::get('projectproperties/{id}','HomeController@projectProperties');
Route::get('logout',function(){
		\Auth::logout();
          return redirect('/');
	});

/***********************Admin-Section****************************/

Route::get('admin/login','Admin\LoginController@login');
Route::post('admin/login','Admin\LoginController@authentication');
Route::get('admin/changepassword','Admin\LoginController@changePassword');
Route::post('admin/changepassword','Admin\LoginController@adminchangePass');
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

/***********************Purchase-Section****************************/

Route::resource('purchase', 'PurchaseController');
	Route::group(['prefix' => 'property'],function(){
			Route::post('ajaxproperty', 'PurchaseController@ajaxProperty');
	});
	Route::group(['prefix' => 'purchase'],function(){
		Route::post('/status', 'PurchaseController@changeStatus');
	});

/***********************Project-Section****************************/

Route::resource('project', 'ProjectController');
	Route::group(['prefix' => 'project'],function(){
		Route::post('/status', 'ProjectController@changeStatus');
	});

/***********************Expense-Section****************************/

Route::resource('expenses', 'ExpenseController');
	Route::group(['prefix' => 'expenses'],function(){
		Route::post('/status', 'ExpenseController@changeStatus');
			Route::get('/payment/{id}','ExpenseController@expensePayment');
			Route::post('/payment/{id}','ExpenseController@expensePaymentAmount');
	});

/***********************Inventory-Section****************************/

Route::resource('inventory', 'InventoryController');
	Route::group(['prefix' => 'inventory'],function(){
		Route::post('/status', 'InventoryController@changeStatus');
	});

/***********************Expense-Category-Section****************************/

Route::resource('expensecategories', 'ExpenseCategoryController');
	Route::group(['prefix' => 'expensecategories'],function(){
		Route::post('/status', 'ExpenseCategoryController@changeStatus');
	});

/***********************Vendor-Section****************************/

Route::resource('vendors', 'VendorController');
	Route::group(['prefix' => 'vendors'],function(){
		Route::post('/status', 'VendorController@changeStatus');
	});

/***********************Property-Section****************************/

Route::resource('property', 'PropertyController');
	Route::group(['prefix' => 'property'],function(){
		Route::post('/status', 'PropertyController@changeStatus');
	});

/***********************Client-Section****************************/
Route::resource('client', 'ClientController');
	Route::group(['prefix' => 'client'],function(){
		Route::post('/status', 'ClientController@changeStatus');
		Route::get('/{id}/changepassword','ClientController@changePassword');
		Route::post('/{id}/changepassword','ClientController@changePasswordForm');
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

/***********************Agents-Section****************************/

Route::resource('agent', 'AgentController');
	Route::group(['prefix' => 'agent'],function(){
		Route::post('/status', 'AgentController@changeStatus');
	    Route::get('/wallet/{id}','AgentController@wallet');
	    Route::post('/wallet/{id}','AgentController@walletAmount');
	});

/***********************Plans-Section****************************/

Route::resource('plans', 'PlanController');
	Route::group(['prefix' => 'plans'],function(){
		Route::post('/status', 'PlanController@changeStatus');
	});

/***********************Leads-Section****************************/
Route::get('contactleads','LeadController@contactLead');
Route::resource('leads', 'LeadController');
	Route::group(['prefix' => 'leads'],function(){
		Route::post('/status', 'LeadController@changeStatus');
	});
	Route::group(['prefix' => 'contactleads'],function(){
		Route::post('/status', 'LeadController@changeStatusContacts');
	});

/***********************Company-Section****************************/

Route::resource('company', 'CompanyController');
	Route::group(['prefix' => 'company'],function(){
		Route::post('/status', 'CompanyController@changeStatus');
	});

/***********************Services-Section****************************/

Route::resource('service', 'ServiceController');
	Route::group(['prefix' => 'service'],function(){
		Route::post('/status', 'ServiceController@changeStatus');
	});

/***********************Social Media-Section****************************/
Route::resource('social', 'SocialMediaController');

/***********************Contact-Address-Section****************************/

Route::resource('contact', 'ContactController');

/***********************Notice-Section****************************/

Route::resource('notice', 'NoticeController');
	Route::group(['prefix' => 'notice'],function(){
		Route::post('/status', 'NoticeController@changeStatus');
	});
/***********************staticPage-Section****************************/

Route::resource('static_pages', 'StaticController');
});

