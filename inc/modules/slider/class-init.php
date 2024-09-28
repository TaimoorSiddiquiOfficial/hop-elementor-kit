<?php

namespace Hop_EL_Kit\Modules\Slider;

use Hop_EL_Kit\SingletonTrait;

class Init {

	use SingletonTrait;

	public function __construct() {
		$this->includes();
	}

	public function includes() {
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/slider/class-post-type.php';
		require_once HOP_EKIT_PLUGIN_PATH . 'inc/modules/slider/class-taxonomy-metabox.php';
	}
}

Init::instance();
