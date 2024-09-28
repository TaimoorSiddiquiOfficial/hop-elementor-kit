<?php

namespace Elementor;

use Hop_EL_Kit\Utilities\Widget_Loop_Trait;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || exit;

class Hop_Ekit_Widget_Loop_Item_Read_More extends Widget_Button {

	use Widget_Loop_Trait;

	public function get_name() {
		return 'hop-loop-item-read-more';
	}

	public function get_title() {
		return esc_html__( 'Item Read more', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'eicon-button';
	}

	public function get_keywords() {
		return array( 'read more', 'link' );
	}

	protected function register_controls() {
		parent::register_controls();

		$this->update_control(
			'text',
			array(
				'default'     => esc_html__( 'Read more', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'Read more', 'hop-elementor-kit' ),
			)
		);

		$this->update_control(
			'link',
			array(
				'dynamic' => array(
					'default' => \Elementor\Plugin::$instance->dynamic_tags->tag_data_to_tag_text( null,
						'hop-item-url' ),
				),
			),
			array(
				'recursive' => true,
			)
		);
	}
}
