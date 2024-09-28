<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Course_Price extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-course-price';
	}

	public function get_title() {
		return esc_html__( ' Course Price', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-price-list';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE );
	}

	public function get_help_url() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_price_style',
			array(
				'label' => esc_html__( 'Price', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'text_align',
			array(
				'label'     => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}}' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course__price__price' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-course__price__price',
			)
		);

		$this->add_control(
			'regular_heading',
			array(
				'label'     => esc_html__( 'Origin Price', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'regular_price_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course__price__origin' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'regular_price_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-course__price__origin',
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-course/before-preview-query' );

		$course = learn_press_get_course();
		$user   = learn_press_get_current_user();

		if ( ! $course ) {
			return;
		}

		$price = $course->get_price_html();

		if ( ! $price ) {
			return;
		}

		$settings = $this->get_settings_for_display();
		?>

		<div class="hop-ekit-single-course__price">
			<?php
			if ( $course->has_sale_price() ) : ?>
				<span class="hop-ekit-single-course__price__origin"> <?php
					echo wp_kses_post( $course->get_origin_price_html() ); ?></span>
			<?php
			endif; ?>

			<span class="hop-ekit-single-course__price__price"><?php
				echo wp_kses_post( $price ); ?></span>
		</div>

		<?php
		do_action( 'hop-ekit/modules/single-course/after-preview-query' );
	}
}
