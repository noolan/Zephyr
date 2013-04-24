<?php

//View::share('categories', DB::table('categories')->lists('name'));
/*
|--------------------------------------------------------------------------
| Basic Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function() {
	return View::make('test')->with('title', 'Home');
});


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('login', function() {
	return View::make('login')->with('title', 'Login');
});

Route::post('login', function() {
	$credentials = Input::only('email', 'password');
	$remember = (Input::get('password') == 'remember');

	if (Auth::attempt($credentials, $remember))
		return Redirect::to(Session::get('route', '/'));
	else
		return Redirect::to('login')->withInput(Input::only('email', 'remember'))
																->with('alert', 'error')
																->with('alert-message', 'Email address or password not found');
});

Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('login');
});


/*
|--------------------------------------------------------------------------
| Asset Routes
|--------------------------------------------------------------------------
*/

Route::get('assets/{category_name?}', array('before' => 'auth', function($category_name = null) {
	if (is_null($category_name)) {
		return View::make('asset.list')->with('title', 'Tracker - All Assets')
																	 ->with('assets', Asset::with('category', 'instances.revisions')->get());
	} else {
		$category = Category::with('assets.instances.revisions')->where('name', Str::singular($category_name))->first();
		return View::make('asset.list')->with('title', $category_name)
																	 ->with('assets', $category->assets);
	}
}));



Route::get('asset/{asset_id?}', array('before' => 'auth', function($asset_id = null) {
	if (is_null($asset_id))
		$asset = Asset::newEmpty();
	else
		$asset = Asset::with('category', 'instances.revisions')->where('id', $asset_id)->first();

	return View::make('asset.form')->with('title', 'New Asset')
																 ->with('asset', $asset);
}));

Route::post('asset', array('before' => 'auth', function() {

	if (Input::get('type_id') == Asset::PURCHASE)
		$asset = Asset::purchase(Input::except('type_id', 'renew_until'));
	elseif (Input::get('type_id') == Asset::LICENSE)
		$asset = Asset::license(Input::except('type_id'));

	return Redirect::to('asset/'.$asset->id)->with('alert', 'success')
																					->with('alert-message', 'Asset '.$asset->name.' created.');
}));

Route::post('asset/{asset_id}', array('before' => 'auth', function($asset_id) {
	$asset = Asset::find($asset_id);
	$asset->revise(Input::except('type_id', 'category'));

	return Redirect::to('asset/'.$asset->id)->with('alert', 'success')
																					->with('alert-message', 'Asset '.$asset->name.' updated.');
}));



/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/

Route::get('categories', array('before' => 'auth',function() {
	return View::make('category.list')->with('title', 'Categories')
																		->with('categories', Category::with('assets')->get());
}));