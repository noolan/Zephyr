<?php

class Schema_Task {
	public function run($arguments) {

	}

	public function create($arguments) {
		User::create_schema();

		$user = new User;
		$user->name     = 'admin';
		$user->email    = 'zephyr@noolan.ca';
		$user->password = 'F3rt';
		$user->save();

		Page::create_schema();
		Content::create_schema();
		Post::create_schema();
		Tag::create_schema();

		if (Schema::table_exists('post_tags'))
			Schema::drop('post_tags');

		Schema::create('post_tags', function($table) {
			$table->engine = 'MyISAM';
			$table->increments('id');

			$table->integer('post_id')->unsigned()->index();
			$table->integer('tag_id')->unsigned()->index();

			$table->timestamps();
		});

		$page = new Page;
		$page->title = 'Home';
		$page->slug = 'home';
		$page->save();

		$page->content()->insert( new Content( array( 'text' => 'Put some content here.' ) ) );


	}

}