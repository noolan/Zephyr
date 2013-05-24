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
		return Redirect::to(Session::get('route', $lang.'/admin'));
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
| Admin Routes
|--------------------------------------------------------------------------
*/



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
| View/Edit Page by Id Routes
|--------------------------------------------------------------------------
*/

Route::get('{lang}/page/{id}', function($lang, $id) {
	$page = Page::findOrFail($id);

	if (Auth::check())
		return View::make('page.new')->with('title', 'Page: '.$page->id)
	                                ->with('page',  $page);
	else
		App::abort(404, Lang::get('messages.404'));
})->where('id', '[0-9]+');

Route::post('{lang}/page/{id}', function($lang, $id) {
	$page = Page::findOrFail($id);

	$page->revise(array(
		'language_id' => Input::get('language'),
		'name'        => Input::get('name'),
		'slug'        => Str::slug(Input::get('name')),
		'content'     => Input::get('content')
	));

	return Redirect::to($lang.'/'.$page->slug);
})->where('id', '[0-9]+');



Route::get('{lang}/collections', function($lang) {
	return View::make('collection.list')->with('title', 'Collections')
	                                    ->with('collections', Collection::with('items')->get());
});



/*
|--------------------------------------------------------------------------
| View/Edit Page by Slug Routes
|--------------------------------------------------------------------------
*/

Route::get('{lang}/{segment1?}/{segment2?}/{segment3?}/{segment4?}/{segment5?}', function($lang, $segment1 = '', $segment2 = '', $segment3 = '', $segment4 = '', $segment5 = '') {
	
	$slug = rtrim($segment1.'/'.$segment2.'/'.$segment3.'/'.$segment4.'/'.$segment5, '/');
	//var_dump($slug); die();
	$revision = Revision::where('slug', $slug)->orderBy('created_at', 'DESC')->first();
	if ($revision)
		$resource = $revision->revised;
	else
		App::abort(404, Lang::get('messages.404'));

	if (get_class($resource) == 'Page') {
		if (Auth::check())
			return View::make('page.edit')->with('title', $resource->name)
		                                ->with('page', $resource)
		                                ->with('revisions', $resource->revisions()->pages()->get());
		elseif($resource->landing_page)
			return View::make('page.landing')->with('title', $resource->name)
		                                   ->with('page',  $resource)
		                                   ->with('bulletins', Category::findBySlug('bulletins')->items);
		elseif($resource->contact_page)
			return View::make('page.contact')->with('title', $resource->name)
		                                   ->with('page',  $resource);
		else
			return View::make('page.view')->with('title', $resource->name)
		                                ->with('page',  $resource);
	} elseif (get_class($resource) == 'Category') {
		$breadcrumbs = Category::crumble($slug, 'strtoupper');
		end($breadcrumbs);
		$active = key($breadcrumbs);
		array_pop($breadcrumbs);

		return View::make('category.view')->with('title', $resource->name)
		                                  ->with('category', $resource)
		                                  ->with('collections', $resource->itemsByCollection())
		                                  ->with('sub_categories', $resource->children)
		                                  ->with('breadcrumbs', $breadcrumbs)
		                                  ->with('active', $active);
	} elseif (get_class($resource) == 'Item') {
		$breadcrumbs = Category::crumble($slug, 'strtoupper');
		end($breadcrumbs);
		$active = key($breadcrumbs);
		array_pop($breadcrumbs);

		return View::make('item.view')->with('title', $resource->name)
		                              ->with('item', $resource)
		                              ->with('breadcrumbs', $breadcrumbs)
		                              ->with('active', $active);
	}


	
});

Route::post('{lang}/{page}', function($lang, $page) {
	$page = Page::findBySlug($page);

	$page->revise(array(
		'language_id' => Language::getId(Input::get('language')),
		'name'        => Input::get('name'),
		'slug'        => Str::slug(Input::get('name')),
		'content'     => Input::get('content')
	));

	return Redirect::to($lang.'/'.$page->slug);
});