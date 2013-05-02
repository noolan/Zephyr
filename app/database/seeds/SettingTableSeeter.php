<?php

class SettingTableSeeder extends Seeder {

	public function run() {
		DB::table('settings')->delete();

		Setting::siteName('Gusting Gesticulations', Language::getId('en'));
		Setting::siteNameExtended('and other windy warblings', Language::getId('en'));

		Setting::siteName('gesticulations rafales', Language::getId('français'));
		Setting::siteNameExtended('de vent et d\'autres gazouillements', Language::getId('fr'));

	}
}