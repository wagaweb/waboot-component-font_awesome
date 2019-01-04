<?php
/**
Component Name: Font Awesome
Description: Adds font awesome to Waboot
Category: Styles
Tags: Styles
Version: 1.0.0
Author: Waboot Team <info@waboot.io>
Author URI: http://www.waboot.io
 */

class Font_Awesome extends \WBF\modules\components\Component{
	public function setup() {
		parent::setup();
	}

	public function run() {
		parent::run();
	}

	public function styles() {
		if(!class_exists(\WBF\components\assets\AssetsManager::class)){
			return;
		}
		$assets = [
			'fontawesome-4' => [
				'uri' => $this->directory_uri . '/assets/dist/css/font-awesome-4.7.0.min.css',
				'path' => $this->directory . '/assets/dist/css/font-awesome-4.7.0.min.css',
				'type' => 'css',
				'enqueue' => \Waboot\functions\get_option('fa_version') === 'legacy'
			],
			'fontawesome-regular' => [
				'uri' => $this->directory_uri . '/assets/dist/css/regular.min.css',
				'path' => $this->directory . '/assets/dist/css/regular.min.css',
				'type' => 'css',
				'enqueue' => \Waboot\functions\get_option('fa_version') === 'latest'
			],
			'fontawesome-solid' => [
				'uri' => $this->directory_uri . '/assets/dist/css/solid.min.css',
				'path' => $this->directory . '/assets/dist/css/solid.min.css',
				'type' => 'css',
				'enqueue' => \Waboot\functions\get_option('fa_version') === 'latest'
			],
			'fontawesome-brands' => [
				'uri' => $this->directory_uri . '/assets/dist/css/brands.min.css',
				'path' => $this->directory . '/assets/dist/css/brands.min.css',
				'type' => 'css',
				'enqueue' => \Waboot\functions\get_option('fa_version') === 'latest'
			],
			'fontawesome' => [
				'uri' => $this->directory_uri . '/assets/dist/css/fontawesome.min.css',
				'path' => $this->directory . '/assets/dist/css/fontawesome.min.css',
				'type' => 'css',
				'deps' => ['fontawesome-regular','fontawesome-solid','fontawesome-brands'],
				'enqueue' => \Waboot\functions\get_option('fa_version') === 'latest'
			]
		];
		$am = new \WBF\components\assets\AssetsManager($assets);
		try{
			$am->enqueue();
		}catch (\Exception $e){
			trigger_error($e->getMessage(),E_USER_NOTICE);
		}
	}

	public function register_options() {
		parent::register_options();
		$orgzr = \WBF\modules\options\Organizer::getInstance();

		$orgzr->add_section('fontawesome', _x('FontAwesome','Theme Options tab','waboot'));

		$orgzr->set_section('fontawesome');
		$orgzr->set_group("std_options");

		$orgzr->add([
			'name' => _x( 'FontAwesome version', 'Theme options', 'waboot' ),
			'desc' => _x( 'Choose the FontAwesome version to include', 'Theme options', 'waboot' ),
			'id' => 'fa_version',
			'std' => 'latest',
			'type' => 'radio',
			'options' => array( 'legacy' => 'Legacy (4.7.0)','latest' => 'Latest (5.x)' ),
		]);

		$orgzr->reset_group();
		$orgzr->reset_section();
	}
}