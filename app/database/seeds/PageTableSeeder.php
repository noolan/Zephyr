<?php

class PageTableSeeder extends Seeder {

	public function run() {
		DB::table('pages')->delete();

		Page::add(array(
			'order'     => 1,
			'revisions' => array(
				'english' => array(
					'name'        => 'Home',
					'slug'        => 'home',
					'content'     => 'Welcome to Zephyr'
				),
				'francais' => array(
					'name'        => 'Accueil',
					'slug'        => 'accueil',
					'content'     => 'Bienvenue au Zéphyr'
				)
			)
		));

		Page::add(array(
			'order'     => 2,
			'revisions' => array(
				'english' => array(
					'name'        => 'Contact',
					'slug'        => 'contact',
					'content'     => 'Welcome to Zephyr'
				),
				'francais' => array(
					'name'        => 'Coordonnées',
					'slug'        => 'coordonnees',
					'content'     => 'Laissez-nous un message'
				)
			)
		));

	}
}