<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Product_Rating extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-product-rating';
	}

	public function get_title() {
		return esc_html__( 'Product Rating', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-product-rating';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_PRODUCT );
	}

	public function get_help_url() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_product_rating_style',
			array(
				'label' => esc_html__( 'Style', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'star_color',
			array(
				'label'     => esc_html__( 'Star Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-product__rating .star-rating span:before' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'empty_star_color',
			array(
				'label'     => esc_html__( 'Empty Star Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-product__rating .star-rating::before' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'star_size',
			array(
				'label'     => esc_html__( 'Star Size', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'unit' => 'em',
				),
				'range'     => array(
					'em' => array(
						'min'  => 0,
						'max'  => 4,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-product__rating .star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'show_link',
			array(
				'label'     => esc_html__( 'Show Link', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-product__rating .woocommerce-review-link' => 'display: inline-block;',
				),
			)
		);

		$this->add_control(
			'link_color',
			array(
				'label'     => esc_html__( 'Link Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-product__rating .woocommerce-review-link' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_link' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'text_typography',
				'selector'  => '{{WRAPPER}} .hop-ekit-single-product__rating .woocommerce-review-link',
				'condition' => array(
					'show_link' => 'yes',
				),
			)
		);

		$this->add_control(
			'space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'unit' => 'em',
				),
				'range'      => array(
					'em' => array(
						'min'  => 0,
						'max'  => 4,
						'step' => 0.1,
					),
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-product__rating .woocommerce-product-rating' => 'column-gap: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'show_link' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-product__rating .woocommerce-product-rating' => 'justify-content: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-product/before-preview-query' );
		global $product;
		$product = wc_get_product();

		if ( ! $product ) {
			return;
		}
		$settings     = $this->get_settings_for_display();
		$class_editor = '';
		if ( Plugin::$instance->editor->is_edit_mode() ) {
			$class_editor = ' woocommerce';
		}
		$rating_count = $product->get_rating_count();
		if ( ! wc_review_ratings_enabled() || $rating_count <= 0 ) {
			return;
		}
		?>

		<div class="hop-ekit-single-product__rating<?php
		echo $class_editor; ?>">
			<?php
			wc_get_template( 'single-product/rating.php' ); ?>
		</div>

		<?php
		do_action( 'hop-ekit/modules/single-product/after-preview-query' );
	}
}
