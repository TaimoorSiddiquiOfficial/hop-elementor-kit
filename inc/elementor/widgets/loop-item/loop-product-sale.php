<?php

namespace Elementor;

use Hop_EL_Kit\Custom_Post_Type;
use Hop_EL_Kit\Utilities\Widget_Loop_Trait;

class Hop_Ekit_Widget_Loop_Product_Sale extends Widget_Base {
	use Widget_Loop_Trait;

	public function get_name() {
		return 'hop-loop-product-sale';
	}

	public function get_title() {
		return esc_html__( 'Product Sale Flash', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-text-area';
	}

	public function show_in_panel() {
		$type      = get_post_meta( get_the_ID(), Custom_Post_Type::TYPE, true );
		$post_type = get_post_meta( get_the_ID(), 'hop_loop_item_post_type', true );

		if ( ( ! empty( $post_type ) && $post_type == 'product' ) || $type == 'single-product' ) {
			return true;
		}

		return false;
	}

	public function get_help_url() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => esc_html__( 'Content', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'display',
			array(
				'label'   => esc_html__( 'Display', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'       => esc_html__( 'Text', 'hop-elementor-kit' ),
					'percentage' => esc_html__( 'Percentage', 'hop-elementor-kit' ),
				)
			)
		);
		$this->add_control(
			'label',
			array(
				'label'     => esc_html__( 'Label', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Sale',
				'condition' => array(
					'display' => 'text',
				),
			)
		);
		$this->add_control(
			'text',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER }} .ekit-onsale' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER }} .ekit-onsale',
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$product = wc_get_product( false );

		$settings = $this->get_settings_for_display();
		if ( ! $product ) {
			return;
		}

		if ( $product->is_on_sale() ) :
			$percentage = '';
			if ( $product->get_type() == 'variable' && $settings['display'] == 'percentage' ) {
				$available_variations = $product->get_variation_prices();
				$max_percentage       = 0;

				foreach ( $available_variations['regular_price'] as $key => $regular_price ) {
					$sale_price = $available_variations['sale_price'][ $key ];

					if ( $sale_price < $regular_price ) {
						$percentage = round( ( ( (float) $regular_price - (float) $sale_price ) / (float) $regular_price ) * 100 );

						if ( $percentage > $max_percentage ) {
							$max_percentage = $percentage;
						}
					}
				}

				$percentage = $max_percentage;
			} elseif ( ( $product->get_type() == 'simple' || $product->get_type() == 'external' || $product->get_type() == 'variation' ) && $settings['display'] == 'percentage' ) {
				$percentage = round( ( ( (float) $product->get_regular_price() - (float) $product->get_sale_price() ) / (float) $product->get_regular_price() ) * 100 );
			}

			if ( $percentage ) {
				echo '<span class="ekit-onsale">' . sprintf( _x( '-%d%%', 'sale percentage', 'hop-elementor-kit' ),
						$percentage ) . '</span>';
			} else {
				echo '<span class="ekit-onsale">' . $settings['label'] . '</span>';
			}

		endif;
	}

	public function render_plain_content() {
	}
}
