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

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
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
Route::get('agentenquiry/{id}','HomeController@agentEnquiry');
Route::post('agentenquirysubmission','HomeController@agentEnquirySubmission');
Route::post('agentcontact','HomeController@agentEnquiryModal');
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

Route::get('purchase/showpayment/{id}','PurchaseController@showPayment');
Route::resource('purchase', 'PurchaseController');
	Route::group(['prefix' => 'property'],function(){
			Route::post('ajaxproperty', 'PurchaseController@ajaxProperty');
	});
	Route::group(['prefix' => 'price'],function(){
			Route::post('ajaxprice', 'PurchaseController@ajaxPrice');
	});
	Route::group(['prefix' => 'purchase'],function(){
		Route::post('/status', 'PurchaseController@changeStatus');
		Route::get('/payment/{id}','PurchaseController@purchasePayment');
		Route::post('/payment/{id}','PurchaseController@purchasePaymentAmount');
	});

/***********************Project-Section****************************/

Route::resource('project', 'ProjectController');
	Route::group(['prefix' => 'project'],function(){
		Route::post('/status', 'ProjectController@changeStatus');
	});

/***********************Users-Section****************************/
Route::get('userlevel','UserController@userlevellist');
Route::get('userlevel/create','UserController@createUserLevel');
Route::post('userleveladd','UserController@userLevel');
Route::post('userlevel/status','UserController@changeStatusUserLevel');
Route::get('setpermission/{id}','UserController@setPermissionList');
Route::resource('users', 'UserController');
	Route::group(['prefix' => 'users'],function(){
		Route::post('/status', 'UserController@changeStatus');
	});

/***********************Expense-Section****************************/

Route::get('/showpayment/{id}','ExpenseController@showPayment');
Route::resource('expenses', 'ExpenseController');
	Route::group(['prefix' => 'expenses'],function(){
		Route::post('/status', 'ExpenseController@changeStatus');
			Route::get('/payment/{id}','ExpenseController@expensePayment');
			Route::post('/payment/{id}','ExpenseController@expensePaymentAmount');
	});

/***********************Inventory-Section****************************/
Route::get('/showinventory/{id}','InventoryController@showInventoryEntry');
Route::resource('inventory', 'InventoryController');
	Route::group(['prefix' => 'inventory'],function(){
		Route::post('/status', 'InventoryController@changeStatus');
			Route::get('/entry/{id}','InventoryController@makeEntry');
			Route::post('/entry/{id}','InventoryController@makeEntryInventory');
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

Route::get('agent/wallet_history','AgentController@walletHistory');
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
Route::get('agentleads','LeadController@agentLead');
Route::get('sliderleads','LeadController@sliderLead');
Route::resource('leads', 'LeadController');
	Route::group(['prefix' => 'leads'],function(){
		Route::post('/status', 'LeadController@changeStatus');
	});
	Route::group(['prefix' => 'contactleads'],function(){
		Route::post('/status', 'LeadController@changeStatusContacts');
	});
	Route::group(['prefix' => 'agentleads'],function(){
		Route::post('/status', 'LeadController@changeStatusAgents');
	});
	Route::group(['prefix' => 'sliderleads'],function(){
		Route::post('/status', 'LeadController@changeStatusSlider');
	});

/***********************Company-Section****************************/

Route::resource('company', 'CompanyController');
	Route::group(['prefix' => 'company'],function(){
		Route::post('/status', 'CompanyController@changeStatus');
	});

/***********************Deals-Section****************************/

Route::resource('deals', 'DealsController');
	Route::group(['prefix' => 'property'],function(){
			Route::post('ajaxproperties', 'DealsController@ajaxProperties');
	});
	Route::group(['prefix' => 'area'],function(){
			Route::post('ajaxarea', 'DealsController@ajaxArea');
	});
	Route::group(['prefix' => 'deals'],function(){
		Route::post('/status', 'DealsController@changeStatus');
			Route::get('makeplan/{id}','DealsController@makePaymentPlan');
			Route::post('makeplan/{id}','DealsController@makePaymentPlanForm');
	});

/***********************Services-Section****************************/

Route::resource('service', 'ServiceController');
	Route::group(['prefix' => 'service'],function(){
		Route::post('/status', 'ServiceController@changeStatus');
	});

/***********************staticPage-Section****************************/

Route::resource('static_pages', 'StaticController');

/***********************Social Media-Section****************************/
Route::resource('social', 'SocialMediaController');

/***********************Contact-Address-Section****************************/

Route::resource('contact', 'ContactController');

/***********************Reports-Section****************************/

Route::get('purchasereport', 'ReportController@purchaseReport');
Route::get('salesreport', 'ReportController@salesReport');
Route::get('expensereport', 'ReportController@expenseReport');
Route::get('profitreport', 'ReportController@profitReport');

/***********************Invoices-Section****************************/

Route::get('balanceinvoices', 'ReportController@balanceInvoice');
Route::get('paidinvoices', 'ReportController@paidInvoice');

/***********************Notice-Section****************************/

Route::resource('notice', 'NoticeController');
	Route::group(['prefix' => 'notice'],function(){
		Route::post('/status', 'NoticeController@changeStatus');
	});

/***********************configuration-Section****************************/

Route::get('currencies','ConfigurationController@index');
Route::get('currencies/create','ConfigurationController@currencyAddForm');
Route::post('currencies/store','ConfigurationController@currencyAdd');
Route::post('currencies/status','ConfigurationController@changeStatus');

Route::get('tax','ConfigurationController@tax');
Route::get('tax/add','ConfigurationController@taxAddForm');
Route::post('tax/add','ConfigurationController@taxAdd');
Route::get('tax/edit/{id}','ConfigurationController@taxEditForm');
Route::post('tax/edit/{id}','ConfigurationController@taxEdit');
Route::post('tax/status','ConfigurationController@changeStatusTax');

Route::get('units','ConfigurationController@units');
Route::get('units/create','ConfigurationController@unitsAddForm');
Route::post('units/create','ConfigurationController@unitsAdd');
Route::get('units/edit/{id}','ConfigurationController@unitsEditForm');
Route::post('units/edit/{id}','ConfigurationController@unitEdit');
Route::post('units/status','ConfigurationController@changeStatusUnits');

Route::get('help', 'ConfigurationController@help');
});

