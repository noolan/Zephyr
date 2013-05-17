<?php

/*
|--------------------------------------------------------------------------
| Redirection Routes
|--------------------------------------------------------------------------
*/

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


/*
|--------------------------------------------------------------------------
| New Page Routes
|--------------------------------------------------------------------------
*/

Route::get('{lang}/page', function($lang) {
	if (Auth::guest())
		App::abort(404, Lang::get('messages.404'));

	return View::make('page.new')->with('title', 'New Page');
});

Route::post('{lang}/page', function($lang) {
	$page = Page::add(array(
		'order'     => 1,
		'revisions' => array(
			$lang => array(
				'name'        => Input::get('name'),
				'slug'        => Str::slug(Input::get('name')),
				'content'     => Input::get('content')
			),
		)
	));
	return Redirect::to($lang.'/'.$page->slug);
});


/*
|--------------------------------------------------------------------------
| Edit Page by Slug Routes
|--------------------------------------------------------------------------
*/

Route::get('{lang}/{page}', function($lang, $page) {
	$page = Page::findBySlug($page);

	if (Auth::check())
		return View::make('page.edit')->with('title', $page->name)
	                                ->with('page',  $page)
	                                ->with('revisions', $page->revisions()->pages()->get());
	else
		return View::make('page.view')->with('title', $page->name)->with('page',  $page);
});

Route::post('{lang}/{page}', function($lang, $page) {
	$page = Page::findBySlug($page);

	$page->revise(array(
		'language_id' => Input::get('language'),
		'name'        => Input::get('name'),
		'slug'        => Str::slug(Input::get('name')),
		'content'     => Input::get('content')
	));

	return Redirect::to($lang.'/'.$page->slug);
});


/*
|--------------------------------------------------------------------------
| Edit Page by Id Routes
|--------------------------------------------------------------------------
*/

Route::get('{lang}/page/{id}', function($lang, $id) {
	$page = Page::findOrFail($id);

	if (Auth::check())
		return View::make('page.new')->with('title', 'Page: '.$page->id)
	                                ->with('page',  $page);
	else
		App::abort(404, Lang::get('messages.404'));
});

Route::post('{lang}/page/{id}', function($lang, $id) {
	$page = Page::findOrFail($id);

	$page->revise(array(
		'language_id' => Input::get('language'),
		'name'        => Input::get('name'),
		'slug'        => Str::slug(Input::get('name')),
		'content'     => Input::get('content')
	));

	return Redirect::to($lang.'/'.$page->slug);
});