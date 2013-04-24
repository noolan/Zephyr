<?php

class ItemTableSeeder extends Seeder {

	public function run() {
		DB::table('items')->delete();

		$stream = Stream::find(1);

		$stream->addItem(array(
			'revisions' => array(
				'english' => array(
					'name'      => 'First Post',
					'content'   => 'Wind moves horizontally, while a draft moves vertically.'
				),
				'francais' => array(
					'name'      => 'Premier Message',
					'content'   => 'Vent se déplace horizontalement, tandis qu\'un projet se déplace verticalement.'
				)
			)
		));

	}
}