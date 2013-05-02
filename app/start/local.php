<?php

/*
|--------------------------------------------------------------------------
| Shared Data for Views
|--------------------------------------------------------------------------
*/

View::share('siteName', Setting::siteName());
View::share('siteNameExtended', Setting::siteNameExtended());
View::share('languages', Language::all());
View::share('links', Page::links());

if (Auth::check())
	View::share('orphanPages', Page::noRevisions());