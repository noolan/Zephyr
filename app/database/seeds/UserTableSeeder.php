<?php

class UserTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();

		$nolan = new User;
		$nolan->name     = 'Nolan';
		$nolan->email    = 'nolan@smartgroupinc.ca';
		$nolan->password = 'waffles';
		$nolan->save();

	}
}