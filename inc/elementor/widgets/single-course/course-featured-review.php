<?php
namespace Elementor;

use LearnPress;
use Elementor\Plugin;

defined( 'ABSPATH' ) || exit;

class Hop_Ekit_Widget_Course_Featured_Review extends Widget_Base {

    public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

    public function get_name() {
		return 'hop-ekits-course-featured-review';
	}

	public function get_title() {
		return esc_html__( ' Course Featured Review', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-rating';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE );
	}

	public function get_help_url() {
		return '';
	}


    protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'hop-elementor-kit' ),
			)
		);

        $this->add_control(
			'icon',
			array(
				'label'       => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'label_block' => false,
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
                'default' => array(
					'value'   => 'fas fa-quote-right',
					'library' => 'fa-brands',
				),
			)
		);

        $this->end_controls_section();
        $this->_register_style_icon();
        $this->_register_style_title();
        $this->_register_style_review();
	}

    protected function _register_style_icon(){
        $this->start_controls_section(
			'style_icon',
			array(
				'label'     => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			)
		);

        $this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured-review__icon i' => 'color: {{VALUE}};',
				),
			)
		);

        $this->add_control(
			'icon_bg',
			array(
				'label'     => esc_html__( 'Background', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured-review__icon' => 'background: {{VALUE}};',
				),
			)
		);

        $this->add_responsive_control(
			'icon_bg_size',
			[
				'label'      => __( 'Width and Height', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .featured-review__icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
			'icon_size',
			[
				'label'      => __( 'Icon Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .featured-review__icon  i'  => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .featured-review__icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'icon_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .featured-review__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

        $this->end_controls_section();
    }

    protected function _register_style_title(){
        $this->start_controls_section(
			'style_title',
			array(
				'label'     => esc_html__( 'Tilte', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			)
		);

        $this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured-review__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography_title',
				'selector' => '{{WRAPPER}} .featured-review__title',
			)
		);

        $this->add_responsive_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .featured-review__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

        $this->end_controls_section();
    }

    protected function _register_style_review(){
        $this->start_controls_section(
			'style_review',
			array(
				'label'     => esc_html__( 'Review', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			)
		);

        $this->add_control(
			'tabs_align_vertical',
			[
				'label'        => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'       => [
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'    => [
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => array(
					'{{WRAPPER}} .featured-review__stars' => 'text-align: {{VALUE}};',
				),
			]
		);

        $this->add_control(
			'star_color',
			array(
				'label'     => esc_html__( 'Star Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
                'default'   => '#FFB606',
				'selectors' => array(
					'{{WRAPPER}} .featured-review__stars i' => 'color: {{VALUE}};',
				),
			)
		);

        $this->add_control(
			'review_color',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .featured-review__content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography_review',
				'selector' => '{{WRAPPER}} .featured-review__content',
			)
		);

        $this->add_responsive_control(
			'review_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .featured-review__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

        $this->end_controls_section();
    }

	public function render() {
        $settings = $this->get_settings_for_display();

		do_action( 'hop-ekit/modules/single-course/before-preview-query' );

        $course     = learn_press_get_course();

		$review_content = get_post_meta( get_the_ID(), '_lp_featured_review', true );

		if ( ! $review_content ) {
			return;
		}

		$user = learn_press_get_current_user();

		// if ( ! $user ) {
		// 	return;
		// }

		// if ( $user->has_enrolled_or_finished( get_the_ID() ) ) {
		// 	return;
		// }

        ?>
            <span class="featured-review__icon"><?php Icons_Manager::render_icon( $settings['icon'] ); ?></span>
        <?php

		learn_press_get_template(
			'single-course/featured-review',
			array(
				'review_content' => $review_content,
				'review_value'   => 5,
			)
		);

        do_action( 'hop-ekit/modules/single-course/after-preview-query' );
	}
}