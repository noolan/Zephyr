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
					'name'        => 'Contract',
					'slug'        => 'contact',
					'content'     => 'Leave us a message'
				),
				'francais' => array(
					'name'        => 'Coordonnées',
					'slug'        => 'coordonnees',
					'content'     => 'Laissez-nous un message'
				),
				'english' => array(
					'name'        => 'Contact',
					'slug'        => 'contact',
					'content'     => 'Leave us a message'
				)
			)
		));

		Page::add(array(
			'order'     => 3,
			'revisions' => array(
				'francais' => array(
					'name'        => 'Français Seulement',
					'slug'        => 'francais-seulement',
					'content'     => 'Cette page n\'a pas une traduction en anglais.'
				)
			)
		));

	}
}