<?php

class StreamTableSeeder extends Seeder {

	public function run() {
		DB::table('streams')->delete();

		Stream::add(array(
			'revisions' => array(
				'english' => array(
					'name'      => 'Blog',
					'slug'      => 'blog',
					'item_name' => 'post',
					'content'   => 'Musings on the mysteries of the movements of air'
				),
				'francais' => array(
					'name'      => 'Blog',
					'slug'      => 'blog',
					'item_name' => 'message',
					'content'   => 'Réflexions sur les mystères des mouvements de l\'air'
				)
			)
		));

	}
}