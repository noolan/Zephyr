<?php

class CategoryTableSeeder extends Seeder {

	public function run() {
		DB::table('categories')->delete();
					
		$framework = Category::add(array(
			'revisions'   => array(
				'english' => array(
					'name' => 'Regulatory Framework',
					'slug' => 'framework'
				),
				'francais' => array(
					'name' => 'Cadre Réglementaire',
					'slug' => 'cadre'
				)
			)
		));

		$fma = $framework->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'FMA',
					'slug'      => 'framework/fma'
				),
				'francais' => array(
					'name'      => 'LGFPN',
					'slug'      => 'cadre/lgfpn'
				)
			)
		));
		$fma->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'Legislation',
					'slug'      => 'framework/fma/legislation'
				),
				'francais' => array(
					'name'      => 'Loi et Règlements',
					'slug'      => 'cadre/lgfpn/loi-et-reglements'
				)
			)
		));
		$fma->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'Regulations',
					'slug'      => 'framework/fma/regulations'
				),
				'francais' => array(
					'name'      => 'Normes et procédures de la CFPN',
					'slug'      => 'cadre/lgfpn/Normes-et-procédures-de-la-cpfn'
				)
			)
		));

		$s83 = $framework->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'Section 83',
					'slug'      => 'framework/section-83'
				),
				'francais' => array(
					'name'      => 'Article 83',
					'slug'      => 'framewor/article-83'
				)
			)
		));
		$s83->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'Legislation',
					'slug'      => 'framework/section-83/legislation'
				),
				'francais' => array(
					'name'      => 'Loi et Règlements',
					'slug'      => 'framewor/article-83/loi-et-reglements'
				)
			)
		));
		$s83->addSubCategory(array(
			'revisions'   => array(
				'english' => array(
					'name'      => 'Regulations',
					'slug'      => 'framework/section-83/regulations'
				),
				'francais' => array(
					'name'      => 'Protocole d’entente',
					'slug'      => 'framewor/article-83/protocole-d-entente'
				)
			)
		));

	}
}