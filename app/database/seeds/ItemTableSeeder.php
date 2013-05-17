<?php

class ItemTableSeeder extends Seeder {

	public function run() {
		DB::table('items')->delete();

		$documents = Collection::find(1);

		$documents->addItem(array(
		  'category'  => Category::findBySlug('fma/legislation')->id,
			'revisions' => array(
				'english' => array(
					'name'    => 'First Nations Fiscal Management Act',
					'content' => 'An Act to provide for real property taxation powers of first nations, to create a First Nations Tax Commission, First Nations Financial Management Board, First Nations Finance Authority and First Nations Statistical Institute and to make consequential amendments to other Acts.'
				),
				'francais' => array(
					'name'    => 'Loi sur la gestion financière des Premières nations',
					'content' => 'Loi prévoyant les pouvoirs en matière d\'imposition foncière des premières nations, de créer une Commission des Premières Nations de l\'impôt, les Premières Nations Conseil de gestion financière, Autorité financière des Premières nations et l\'Institut de la statistique des Premières nations et apportant des modifications corrélatives à d\'autres lois.'
				)
			)
		));

	}
}