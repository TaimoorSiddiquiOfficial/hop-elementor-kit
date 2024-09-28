<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Archive_Description extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-archive-desc';
	}

	public function get_title() {
		return esc_html__( 'Archive Description', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-post-excerpt';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return array( 'desc', 'excerpt', 'content' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'page_title_settings',
			[
				'label' => esc_html__( 'Setting', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'align',
			array(
				'label'     => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justified', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-archive-description' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'color',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-archive-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'page_title_typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-archive-description',
			]
		);

		$this->end_controls_section();
	}

	public function render() {
		echo '<div class="hop-ekit-archive-description">' . get_the_archive_description() . '</div>';
	}

	protected function content_template() {
		echo '<div class="hop-ekit-archive-description">' . __( 'Description of archive',
				'hop-elementor-kit' ) . '</div>';
	}
}
