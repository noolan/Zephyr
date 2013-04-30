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

View::share('links', Page::links());

Route::get('/', function() {
	return Redirect::to(Language::current()->abbreviation.'/'.Page::first()->slug);
});

Route::get('{lang}', function($lang) {
	return Redirect::to($lang.'/'.Page::first()->slug);
});



/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('{lang}/login', function($lang) {
	return View::make('login')->with('title', 'Login');
});

Route::post('{lang}/login', function($lang) {
	$credentials = Input::only('email', 'password');
	$remember = (Input::get('password') == 'remember');

	if (Auth::attempt($credentials, $remember))
		return Redirect::to(Session::get('route', '/'));
	else
		return Redirect::to($lang.'/login')->withInput(Input::only('email', 'remember'))
																->with('alert', 'error')
																->with('alert-message', 'Email address or password not found');
});

Route::get('{lang}/logout', function($lang) {
	Auth::logout();
	return Redirect::to($lang.'/login');
});





Route::get('{language}/{page?}', function($language, $page = null) {
	if (is_null($page))
		$page = Page::first();
	else
		$page = Page::findBySlug($page);

	if (Auth::check())
		return View::make('page.edit')->with('title', $page->name)
	                                ->with('page',  $page)
	                                ->with('languages', Language::listAll());
	else
		return View::make('page.view')->with('title', $page->name)->with('page',  $page);

	//return View::make('page.view')->with('title', $page->name)->with('page',  $page);
});
