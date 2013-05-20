<?php

class PageTableSeeder extends Seeder {

	public function run() {
		DB::table('pages')->delete();

		Page::add(array(
			'order'     => 1,
			'revisions' => array(
				'english' => array(
					'name'    => 'Home',
					'slug'    => 'home',
					'content' => 'Welcome to FNTC'
				),
				'francais' => array(
					'name'    => 'Accueil',
					'slug'    => 'accueil',
					'content' => 'Bienvenue à la CFPN'
				)
			)
		));

		Page::add(array(
			'order'     => 2,
			'category'  => Category::findBySlug('framework')->id,
			'revisions' => array(
				'english' => array(
					'name'    => 'Regulatory Framework',
					'slug'    => 'framework'
				),
				'francais' => array(
					'name'    => 'Cadre Réglementaire',
					'slug'    => 'cadre'
				)
			)
		));

		Page::add(array(
			'order'     => 3,
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
			'order'     => 4,
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