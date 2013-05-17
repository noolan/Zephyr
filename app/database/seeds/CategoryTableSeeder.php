<?php

class CategoryTableSeeder extends Seeder {

	public function run() {
		DB::table('category')->delete();
					
		$framework = Category::add(array(
			'revisions'   => array(
				'english' => array(
					'name' => 'Regulatory Framework',
					'slug' => 'regulatory_framework'
				),
				'francais' => array(
					'name' => 'Cadre Réglementaire',
					'slug' => 'cadre_reglementaire',
				)
			)
		));

		$fma = $framework->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'FMA',
					'slug'      => 'fma'
				),
				'francais' => array(
					'name'      => 'LGFPN',
					'slug'      => 'lgfpn'
				)
			)
		));
		$fma->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'Legislation',
					'slug'      => 'legislation'
				),
				'francais' => array(
					'name'      => 'Loi et Règlements',
					'slug'      => 'loi-et-reglements'
				)
			)
		));
		$fma->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'Regulations',
					'slug'      => 'regulations'
				),
				'francais' => array(
					'name'      => 'Normes et procédures de la CFPN',
					'slug'      => 'Normes-et-procédures-de-la-cpfn'
				)
			)
		));

		$s83 = $framework->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'Section 83',
					'slug'      => 'section-83'
				),
				'francais' => array(
					'name'      => 'Article 83',
					'slug'      => 'article-83'
				)
			)
		));
		$s83->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'Legislation',
					'slug'      => 'legislation'
				),
				'francais' => array(
					'name'      => 'Loi et Règlements',
					'slug'      => 'loi-et-reglements'
				)
			)
		));
		$s83->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'Regulations',
					'slug'      => 'regulations'
				),
				'francais' => array(
					'name'      => 'Protocole d’entente',
					'slug'      => 'protocole-d-entente'
				)
			)
		));

	}
}