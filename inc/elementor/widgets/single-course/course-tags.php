<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Course_Tags extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-course-tags';
	}

	public function get_title() {
		return esc_html__( ' Course Tags', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-tags';
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
			'singular',
			array(
				'label'       => esc_html__( 'Singular', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Tag:', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'plural',
			array(
				'label'       => esc_html__( 'Plural', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Tags:', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'separator',
			array(
				'label'       => esc_html__( 'Separator', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => ', ',
				'description' => esc_html__( 'String to use between the category.', 'hop-elementor-kit' ),
			)
		);

		$this->end_controls_section();

		$this->register_style_control();
	}

	protected function register_style_control() {
		$this->start_controls_section(
			'section_style_category',
			array(
				'label' => esc_html__( 'Tags', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'style_label',
			array(
				'label'     => esc_html__( 'Label', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course__tags__label' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-course__tags__label',
			)
		);

		$this->add_control(
			'style_content',
			array(
				'label'     => esc_html__( 'Content', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course__tags__content, {{WRAPPER}} .hop-ekit-single-course__tags__content > *' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'content_color_hover',
			array(
				'label'     => esc_html__( 'Color Hover', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-course__tags__content a:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-course__tags__content, {{WRAPPER}} .hop-ekit-single-course__tags__content > *',
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-course/before-preview-query' );

		$settings = $this->get_settings_for_display();

		$terms = get_the_terms( '', 'course_tag' );

		if ( is_wp_error( $terms ) ) {
			return;
		}

		if ( empty( $terms ) ) {
			return;
		}

		$label = ! empty( $settings['singular'] ) ? $settings['singular'] : esc_html__( 'Tag:', 'hop-elementor-kit' );

		if ( count( $terms ) > 1 ) {
			$label = ! empty( $settings['plural'] ) ? $settings['plural'] : esc_html__( 'Tags:', 'hop-elementor-kit' );
		}

		$tags = get_the_term_list( '', 'course_tag', '', $settings['separator'] );

		if ( empty( $tags ) ) {
			return;
		}
		?>

		<div class="hop-ekit-single-course__tags">
			<span class="hop-ekit-single-course__tags__label"><?php
				echo esc_html( $label ); ?></span>
			<span class="hop-ekit-single-course__tags__content">
				<?php
				echo wp_kses_post( $tags ); ?>
			</span>
		</div>

		<?php
		do_action( 'hop-ekit/modules/single-course/after-preview-query' );
	}
}
