<?php

class LanguageTableSeeder extends Seeder {

	public function run() {
		DB::table('languages')->delete();

		Language::create(array(
			'name' => 'english',
			'abbreviation' => 'en'
		));

		Language::create(array(
			'name' => 'français',
			'abbreviation' => 'fr'
		));

	}
}