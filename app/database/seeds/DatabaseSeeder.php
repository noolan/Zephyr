<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		$this->call('UserTableSeeder');
		$this->call('LanguageTableSeeder');
		$this->call('SettingTableSeeder');
		$this->call('PageTableSeeder');
		$this->call('StreamTableSeeder');
		$this->call('ItemTableSeeder');
	}

}