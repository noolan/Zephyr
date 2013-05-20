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
		$this->call('CategoryTableSeeder');
		$this->call('PageTableSeeder');
		$this->call('CollectionTableSeeder');
		$this->call('ItemTableSeeder');
	}

}