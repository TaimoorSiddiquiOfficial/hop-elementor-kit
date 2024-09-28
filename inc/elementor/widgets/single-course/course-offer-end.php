<?php

namespace Elementor;

class Hop_Ekit_Widget_Course_Offer_End extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-course-offer-end';
	}

	public function get_title() {
		return esc_html__( 'Course Offer End', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon  eicon-countdown';
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
			'text',
			array(
				'label'   => esc_html__( 'Text', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'This offer ends in',
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'       => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
			)
		);

		$this->end_controls_section();
		$this->register_controls_label();
		$this->_register_style_offer_end();
	}

	protected function register_controls_label() {
		$this->start_controls_section(
			'section_label',
			array(
				'label' => esc_html__( 'Label', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'label_days',
			[
				'label'       => esc_html__( 'Days', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'd :', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'Days', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'label_hours',
			[
				'label'       => esc_html__( 'Hours', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'h :', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'Hours', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'label_minutes',
			[
				'label'       => esc_html__( 'Minutes', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'm :', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'Minutes', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'label_seconds',
			[
				'label'       => esc_html__( 'Seconds', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 's', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'Seconds', 'hop-elementor-kit' ),
			]
		);
		$this->end_controls_section();
	}

	protected function _register_style_offer_end() {
		$this->start_controls_section(
			'section_offer_date_style',
			array(
				'label' => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course__offer-end i'        => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-ekit-single-course__offer-end svg path' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-course__offer-end i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hop-ekit-single-course__offer-end svg' => 'width: {{SIZE}}{{UNIT}}; height: auto',
				),
			)
		);
		$this->add_responsive_control(
			'icon_spacing',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'body:not(.rtl) {{WRAPPER}} .hop-ekit-single-course__offer-end i, body:not(.rtl) {{WRAPPER}} .hop-ekit-single-course__offer-end svg' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .hop-ekit-single-course__offer-end i,body.rtl {{WRAPPER}} .hop-ekit-single-course__offer-end svg'              => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			array(
				'label' => esc_html__( 'Text', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course__offer-end' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-course__offer-end',
			)
		);

		$this->add_responsive_control(
			'text_and_date_spacing',
			array(
				'label'     => esc_html__( 'Spacing', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'body:not(.rtl) {{WRAPPER}} .hop-ekit-single-course__offer-end .text' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .hop-ekit-single-course__offer-end .text'       => 'margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	private function render_countdown_item( $label ) {
		$settings = $this->get_settings_for_display();
		$string   = '<div class="countdown-item"><span class="countdown-digits countdown-' . $label . '">00</span>';
		$string   .= '<span class="countdown-label">' . $settings[ 'label_' . $label ] . '</span>';
		$string   .= '</div>';

		return $string;
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-course/before-preview-query' );
		$settings = $this->get_settings_for_display();
		$course   = learn_press_get_course();
		$user     = learn_press_get_current_user();

		if ( ! $course ) {
			return;
		}

		if ( $user && $user->has_enrolled_course( get_the_ID() ) ) {
			return;
		}

		$has_sale = $course->has_sale_price();
		if ( ! $has_sale ) {
			return;
		}
		$date_end = get_post_meta( get_the_ID(), '_lp_sale_end', true );

		if ( $date_end ) : ?>
			<div class="hop-ekit-single-course__offer-end">

				<?php
				Icons_Manager::render_icon( $settings['icon'] ); ?>

				<?php
				if ( $settings['text'] ) {
					echo '<span class="text">' . esc_html( $settings['text'] ) . '</span>';
				} ?>

				<div class="hop-ekits-countdown-wrapper" data-date_end="<?php
				echo strtotime( $date_end ); ?>">
					<?php
					$list_labels = [ 'days', 'hours', 'minutes', 'seconds' ];
					foreach ( $list_labels as $label ) {
						echo wp_kses_post( $this->render_countdown_item( $label ) );
					}
					?>
				</div>
			</div>
		<?php
		endif;

		do_action( 'hop-ekit/modules/single-course/after-preview-query' );
	}

	public function render_plain_content() {
	}
}
