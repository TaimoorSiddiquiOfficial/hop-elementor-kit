<?php

namespace Elementor;

use Hop_EL_Kit\Utilities\Widget_Loop_Trait;
use Elementor\Widget_Image;

defined( 'ABSPATH' ) || exit;

class Hop_Ekit_Widget_Loop_Item_Featured_Image extends Widget_Image {

	use Widget_Loop_Trait;

	public function get_name() {
		return 'hop-loop-item-featured-image';
	}

	public function get_title() {
		return esc_html__( 'Item Featured Image', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'eicon-featured-image';
	}

	public function get_keywords() {
		return array( 'image', 'featured', 'thumbnail' );
	}

	public function get_inline_css_depends() {
		return array(
			array(
				'name'               => 'image',
				'is_core_dependency' => true,
			),
		);
	}

	protected function register_controls() {
		parent::register_controls();

		$this->update_control(
			'image',
			array(
				'dynamic' => array(
					'default' => \Elementor\Plugin::$instance->dynamic_tags->tag_data_to_tag_text( null,
						'hop-item-featured-image' ),
				),
			),
			array(
				'recursive' => true,
			)
		);
	}
}
