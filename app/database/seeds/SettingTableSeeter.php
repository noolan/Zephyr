<?php

class SettingTableSeeder extends Seeder {

	public function run() {
		DB::table('settings')->delete();

		Setting::siteName('First Nations Tax Commission', Language::getId('en'));
		Setting::siteNameExtended('Commission de la fiscalité des premières nations', Language::getId('en'));

		Setting::siteName('Commission de la fiscalité des premières nations', Language::getId('français'));
		Setting::siteNameExtended('First Nations Tax Commission', Language::getId('fr'));

	}
}