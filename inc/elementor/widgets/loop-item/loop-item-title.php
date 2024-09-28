<?php

namespace Elementor;

use Elementor\Widget_Heading;
use Hop_EL_Kit\Utilities\Widget_Loop_Trait;

defined( 'ABSPATH' ) || exit;

class Hop_Ekit_Widget_Loop_Item_Title extends Widget_Heading {

	use Widget_Loop_Trait;

	public function get_name() {
		return 'hop-loop-item-title';
	}

	public function get_title() {
		return esc_html__( 'Item Title', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'eicon-post-title';
	}

	public function get_keywords() {
		return array( 'title', 'heading' );
	}

	protected function register_controls() {
		parent::register_controls();

		$this->update_control(
			'title',
			array(
				'dynamic' => array(
					'default' => \Elementor\Plugin::$instance->dynamic_tags->tag_data_to_tag_text( null,
						'hop-item-title' ),
				),
			),
			array(
				'recursive' => true,
			)
		);

		$this->update_control(
			'header_size',
			array(
				'default' => 'h1',
			)
		);

		$this->start_controls_section(
			'section_style',
			array(
				'label' => esc_html__( 'Style', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_max_line',
			array(
				'label'       => esc_html__( 'Max Line', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => 0,
				'step'        => 1,
				'selectors'   => array(
					'{{WRAPPER}} .elementor-heading-title' => 'display: -webkit-box; text-overflow: ellipsis; -webkit-line-clamp: {{VALUE}};-webkit-box-orient:vertical; overflow: hidden;',
				),
			)
		);

		$this->end_controls_section();
	}
}
