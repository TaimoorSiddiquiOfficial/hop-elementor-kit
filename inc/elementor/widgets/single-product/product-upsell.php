<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Product_Upsell extends Hop_Ekit_Products_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-product-upsell';
	}

	public function get_title() {
		return esc_html__( 'Product Upsells', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-product-upsell';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_PRODUCT );
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
			'limit',
			array(
				'label'       => esc_html__( 'Limit', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 4,
				'description' => esc_html__( 'Enter 0 for view all product.', 'hop-elementor-kit' ),
				'min'         => 0,
				'max'         => 20,
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => esc_html__( 'Columns', 'hop-elementor-kit' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 4,
				'tablet_default' => 3,
				'mobile_default' => 2,
				'min'            => 1,
				'max'            => 6,
				'selectors'      => array(
					'{{WRAPPER}} .hop-ekit-single-product__upsells .upsells.products ul.products' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
				),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => esc_html__( 'Order By', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'       => esc_html__( 'Date', 'hop-elementor-kit' ),
					'title'      => esc_html__( 'Title', 'hop-elementor-kit' ),
					'price'      => esc_html__( 'Price', 'hop-elementor-kit' ),
					'popularity' => esc_html__( 'Popularity', 'hop-elementor-kit' ),
					'rating'     => esc_html__( 'Rating', 'hop-elementor-kit' ),
					'rand'       => esc_html__( 'Random', 'hop-elementor-kit' ),
					'menu_order' => esc_html__( 'Menu Order', 'hop-elementor-kit' ),
				),
			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => esc_html__( 'Order', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => array(
					'asc'  => esc_html__( 'ASC', 'hop-elementor-kit' ),
					'desc' => esc_html__( 'DESC', 'hop-elementor-kit' ),
				),
			)
		);

		$this->end_controls_section();

		$this->register_heading_controls();

		parent::register_controls();
	}

	protected function register_heading_controls() {
		$this->start_controls_section(
			'section_style_heading_product',
			array(
				'label' => esc_html__( 'Heading', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'show_heading',
			array(
				'label'        => esc_html__( 'Heading', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_off'    => esc_html__( 'Hide', 'hop-elementor-kit' ),
				'label_on'     => esc_html__( 'Show', 'hop-elementor-kit' ),
				'default'      => 'yes',
				'return_value' => 'yes',
				'prefix_class' => 'hop-ekit-single-product__upsells--show-heading-',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .products > h2' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'show_heading!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'heading_typography',
				'selector'  => '{{WRAPPER}} .products > h2',
				'condition' => array(
					'show_heading!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'heading_text_align',
			array(
				'label'     => esc_html__( 'Text Align', 'hop-elementor-kit' ),
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
					'{{WRAPPER}} .products > h2' => 'text-align: {{VALUE}}',
				),
				'condition' => array(
					'show_heading!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'heading_spacing',
			array(
				'label'      => esc_html__( 'Spacing', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .products > h2' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'show_heading!' => '',
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-product/before-preview-query' );

		$product = wc_get_product( false );

		if ( ! $product ) {
			return;
		}

		$settings = $this->get_settings_for_display();
		$limit    = '-1';
		$columns  = 4;
		$orderby  = 'rand';
		$order    = 'desc';

		if ( ! empty( $settings['columns'] ) ) {
			$columns = $settings['columns'];
		}

		if ( ! empty( $settings['limit'] ) ) {
			$limit = $settings['limit'];
		}

		if ( ! empty( $settings['orderby'] ) ) {
			$orderby = $settings['orderby'];
		}

		if ( ! empty( $settings['order'] ) ) {
			$order = $settings['order'];
		}

		ob_start();
		woocommerce_upsell_display( $limit, $columns, $orderby, $order );
		$html = ob_get_clean();
		?>

		<div class="hop-ekit-single-product__upsells">
			<?php
			Utils::print_unescaped_internal_string( str_replace( '<ul class="products',
				'<ul class="products hop-ekit-archive-product__grid', $html ) ); ?>
		</div>

		<?php
		do_action( 'hop-ekit/modules/single-product/after-preview-query' );
	}
}
