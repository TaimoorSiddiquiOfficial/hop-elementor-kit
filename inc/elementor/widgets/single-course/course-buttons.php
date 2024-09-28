<?php

namespace Elementor;

use Hop_EL_Kit\GroupControlTrait;

class Hop_Ekit_Widget_Course_Buttons extends Widget_Base {
	use GroupControlTrait;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-course-buttons';
	}

	public function get_title() {
		return esc_html__( ' Course Buttons', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-button';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE );
	}

	public function get_help_url() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => esc_html__( 'Buttons', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'align',
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
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course__buttons' => 'text-align: {{VALUE}}',
					'{{WRAPPER}}  button'                           => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'button_width',
			array(
				'label'     => esc_html__( 'Width %', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}  button' => 'width: {{VALUE}}%;',
					'{{WRAPPER}} form'    => 'display:block;',
				),
			)
		);

		$this->register_button_style( 'global', 'button' );

		$this->end_controls_section();
		// Start now button
		$this->start_controls_section(
			'section_start_style',
			array(
				'label' => esc_html__( 'Start', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->register_icon_button( 'start_now' );
		$this->register_button_style( 'start_now', 'form button.button-enroll-course' );
		$this->end_controls_section();

		// Continue button
		$this->start_controls_section(
			'section_continue_style',
			array(
				'label' => esc_html__( 'Continue', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->register_icon_button( 'continue' );
		$this->register_button_style( 'continue', 'form[name="continue-course"] button' );
		$this->end_controls_section();

		// Purchase button
		$this->start_controls_section(
			'section_purchase_style',
			array(
				'label' => esc_html__( 'Purchase', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->register_icon_button( 'purchase' );
		$this->register_button_style( 'purchase', 'form[name="purchase-course"] button' );
		$this->end_controls_section();
		// Finish button
		$this->start_controls_section(
			'section_finish_style',
			array(
				'label' => esc_html__( 'Finish', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->register_icon_button( 'finish' );
		$this->register_button_style( 'finish', 'form button.lp-btn-finish-course' );
		$this->end_controls_section();

		// Retake button
		$this->start_controls_section(
			'section_retake_style',
			array(
				'label' => esc_html__( 'Retake', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->register_icon_button( 'retake' );
		$this->register_button_style( 'retake', 'form button.button-retake-course' );
		$this->end_controls_section();

		// External button
		$this->start_controls_section(
			'section_external_style',
			array(
				'label' => esc_html__( 'External link', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->register_icon_button( 'external' );
		$this->register_button_style( 'external', 'form[name="course-external-link"] button' );
		$this->end_controls_section();
	}

	protected function register_icon_button( string $prefix_name ) {
		$this->add_control(
			$prefix_name . '_icons',
			[
				'label'       => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
			]
		);
		$this->add_control(
			$prefix_name . '_btn_text',
			array(
				'label'       => esc_html__( 'Button Text', 'hop-elementor-kit' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
			)
		);
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-course/before-preview-query' );

		$course = learn_press_get_course();

		if ( ! $course ) {
			return;
		}
		$list_buttons = array( 'enroll', 'purchase', 'continue', 'external', 'finish', 'retake' );
		foreach ( $list_buttons as $list_button ) {
			add_filter(
				'learn-press/' . $list_button . '-course-button-text',
				function ( $text ) use ( $list_button ) {
					if ( $list_button == 'enroll' ) {
						$list_button = 'start_now';
					}
					$settings = $this->get_settings_for_display();
					if ( ! empty( $settings[ $list_button . '_icons' ]['value'] ) ) {
						Icons_Manager::render_icon( $settings[ $list_button . '_icons' ],
							array( 'aria-hidden' => 'true' ) );
					}
					if ( $settings[ $list_button . '_btn_text' ] ) {
						$text = $settings[ $list_button . '_btn_text' ];
					}
					echo $text;
				}
			);
		}
		?>

		<div class="hop-ekit-single-course__buttons">
			<?php
			do_action( 'learn-press/before-course-buttons' );

			do_action( 'learn-press/course-buttons' );

			do_action( 'learn-press/after-course-buttons' );
			?>
		</div>

		<?php
		do_action( 'hop-ekit/modules/single-course/after-preview-query' );
	}
}
