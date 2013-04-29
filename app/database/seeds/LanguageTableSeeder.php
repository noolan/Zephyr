<?php

class LanguageTableSeeder extends Seeder {

	public function run() {
		DB::table('languages')->delete();

		Language::create(array(
			'name'         => 'english',
			'abbreviation' => 'en',
			'default'      => true
		));

		Language::create(array(
			'name'         => 'français',
			'abbreviation' => 'fr'
		));

	}
}