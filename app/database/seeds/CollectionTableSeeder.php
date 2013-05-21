<?php

class CollectionTableSeeder extends Seeder {

	public function run() {
		DB::table('collections')->delete();

		Collection::add(array(
		  'item_sort'   => Collection::SORT_CREATED_DESC,
		  'type'        => Collection::DOCUMENT,
			'revisions'   => array(
				'english' => array(
					'item_name' => 'document'
				),
				'francais' => array(
					'item_name' => 'document'
				)
			)
		));
		Collection::add(array(
		  'item_sort'   => Collection::SORT_START_ASC,
		  'type'        => Collection::NOTICE,
			'revisions'   => array(
				'english' => array(
					'item_name' => 'bulletin'
				),
				'francais' => array(
					'item_name' => 'bulletin'
				)
			)
		));

	}
}