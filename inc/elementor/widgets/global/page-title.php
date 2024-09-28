<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Page_Title extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		add_filter( 'get_the_archive_title_prefix', '__return_false' ); 
	}

	public function get_name() {
		return 'hop-ekits-page-title';
	}

	public function get_title() {
		return esc_html__( 'Page Title', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-site-title';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'page title',
			'title',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content',
			[
				'label' => esc_html__( 'Page Title', 'hop-elementor-kit' )
			]
		);

		$this->add_control(
			'tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h2',
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'     => esc_html__( 'Text Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					]
				],
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-page-title' => 'text-align: {{VALUE}};'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'page_title_settings',
			[
				'label' => esc_html__( 'Setting', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'page_title_typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-page-title .page-title',
			]
		);
		$this->add_control(
			'page_title_color',
			[
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-page-title .page-title' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'blend_mode',
			array(
				'label'     => esc_html__( 'Blend Mode', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''            => esc_html__( 'Normal', 'hop-elementor-kit' ),
					'multiply'    => 'Multiply',
					'screen'      => 'Screen',
					'overlay'     => 'Overlay',
					'darken'      => 'Darken',
					'lighten'     => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation'  => 'Saturation',
					'color'       => 'Color',
					'difference'  => 'Difference',
					'exclusion'   => 'Exclusion',
					'hue'         => 'Hue',
					'luminosity'  => 'Luminosity',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-page-title .page-title' => 'mix-blend-mode: {{VALUE}}',
				),
				'separator' => 'none',
			)
		);
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="hop-ekit-page-title">
		<?php
		$page_title_tag = Utils::validate_html_tag($settings['tag']);
			echo sprintf('<%s class="page-title">%s</%s>', $page_title_tag, $this->render_page_title(), $page_title_tag);	
		?>
		</div>
		<?php
	}

	private function render_page_title() {
		$heading_title = esc_html__( 'Page title', 'hop-elementor-kit' );
		if ( is_404() ) {
			$heading_title = esc_html__( '404 Page', 'hop-elementor-kit' );
		} elseif ( is_search() ) {
			$heading_title = sprintf( esc_html__( 'Search Results for: %s', 'hop-elementor-kit' ),
				get_search_query() );
		} elseif ( is_page() || is_single() ) {
			$heading_title = get_the_title();
		} elseif ( ! is_front_page() && is_home() ) {
			$heading_title = esc_html__( 'Blog', 'hop-elementor-kit' );;
		} elseif ( isset( $_GET['c_search'] ) ) {
			$heading_title = sprintf( '%s %s', __( 'Search results for: ', 'hop-elementor-kit' ),
				esc_html( $_GET['c_search'] ) );
		} else {
			$heading_title = get_the_archive_title();
		}

		return apply_filters( 'hop-ekit/widgets/page-title', wp_kses_post( $heading_title ) );
	}
}
