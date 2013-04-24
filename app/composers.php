<?php

class BootstrapComposer {
	public function compose($view) {
		$view->with('categories', DB::table('categories')->lists('name'));
	}
}