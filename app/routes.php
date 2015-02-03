<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/



// Index Page
Route::get('/', function()
{
	if( Auth::check() ){
		return Redirect::action('dashboard');
	}else{
		return Redirect::guest('login');
	}
});

// Login Page
Route::get('login', function()
{
    $createAccountUrl = action('AccountController@createAccount');
    $loginUrl = action('AccountController@login');
	return View::make('login/loginPage', array(
	    'createAccountUrl' => $createAccountUrl,
	    'loginUrl' => $loginUrl
    ));
});

// Login Page in Alert Login Error
Route::get('login/error', function()
{
    $createAccountUrl = action('AccountController@createAccount');
    $loginUrl = action('AccountController@login');
    $loginError = true;
	return View::make('login/loginPage', array(
	    'createAccountUrl' => $createAccountUrl,
	    'loginUrl' => $loginUrl,
	    'loginError' => $loginError
    ));
});

// Login Process
Route::post('login', 'AccountController@login');

// Logout
Route::get('logout', function()
{
    Auth::logout(); 
    return Redirect::guest('/');
});

Route::controller('password', 'RemindersController');

/*
/-----------------------------------
/ APIs
/-----------------------------------
*/
Route::get('api/checkEmail', 'AccountController@checkEmailExist');
Route::post('api/createAccount', 'AccountController@createAccount');
Route::get('api/users', 'UserController@getUsers');
Route::get('api/user/{id}', 'UserController@getUser');

/*
/-----------------------------------
/ apply auth filter group
/-----------------------------------
*/
Route::group(array('before' => 'auth'), function()
{
    // Dashboard
    Route::get('dashboard', array('uses' => 'DashboardController@dashboard', 'as' => 'dashboard'));
    
    // Memos
    Route::resource('memo', 'MemoController');
    Route::get('memo/attach/{id}', 'MemoController@getAttachFile');
    
    // Stamp
    Route::resource('stamp', 'StampController');
    Route::get('stamp/{id}/add', 'StampController@addStamp');
    Route::delete('stamp/{id}/last', 'StampController@removeLastStamp');
    Route::get('stamp/{id}/calendar', 'StampController@calendar');
    Route::get('stamp/{id}/calendar.json', 'StampController@calendarJson');
    Route::get('stamp/{id}/chart', 'StampController@chart');
    Route::get('stamp/{id}/dailyStampChart.json', 'StampController@dailyStampChartJson');
    Route::get('stamp/{id}/userValueChart.json', 'StampController@userValueChartJson');

    // Moneybook
    Route::resource('moneybook',    'MoneyBookController');
    Route::get('record/startValue', 'RecordController@getStartValue');
    Route::post('record/startValue', 'RecordController@updateStartValue');
    Route::resource('record',       'RecordController');
    Route::resource('fixExpRecord', 'FixExpRecordController');
    Route::get('fixExpRecord.json', 'FixExpRecordController@listJson');
    Route::resource('moneybook-setting', 'MoneyBookSettingController');
    Route::resource('moneybookCategory',        'MoneybookCategoryController');
    
    // Boards
    Route::resource('board',        'BoardController');
    
});

