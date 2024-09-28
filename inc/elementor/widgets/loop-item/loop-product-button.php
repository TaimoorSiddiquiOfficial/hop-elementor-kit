<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Hop_EL_Kit\GroupControlTrait;
use Hop_EL_Kit\Utilities\Widget_Loop_Trait;

defined( 'ABSPATH' ) || exit;

class Hop_Ekit_Widget_Loop_Product_Button extends Widget_Base {

	use Widget_Loop_Trait;
	use GroupControlTrait;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-loop-product-button';
	}

	public function show_in_panel() {
		$post_type = get_post_meta( get_the_ID(), 'hop_loop_item_post_type', true );
		if ( ! empty( $post_type ) && $post_type == 'product' ) {
			return true;
		}

		return false;
	}

	public function get_title() {
		return esc_html__( 'Add To Cart', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-product-add-to-cart';
	}

	public function get_keywords() {
		return array( 'button', 'add to cart' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'display',
			array(
				'label'        => esc_html__( 'Display', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'text',
				'options'      => array(
					'text'         => esc_html__( 'Text', 'hop-elementor-kit' ),
					'icon_tooltip' => esc_html__( 'Icon & ToolTip', 'hop-elementor-kit' ),
				),
				'prefix_class' => 'hop-ekit-btn-',
			)
		);
		$this->add_control(
			'icon_cart',
			array(
				'label'       => esc_html__( 'Choose Icon Add to cart', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'display' => 'icon_tooltip',
				),
				// 'exclude_inline_options' =>['svg']
			)
		);
		$this->add_control(
			'icon_read_more',
			array(
				'label'       => esc_html__('Choose Icon Read More', 'hop-elementor-kit'),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'display' => 'icon_tooltip',
				),
				// 'exclude_inline_options' =>['svg']
			)
		);
		$this->add_control(
			'icon_select_options',
			array(
				'label'       => esc_html__('Choose Icon Select Options', 'hop-elementor-kit'),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'condition'   => array(
					'display' => 'icon_tooltip',
				),
				// 'exclude_inline_options' =>['svg']
			)
		);
		$this->end_controls_section();
		// style button
		$this->start_controls_section(
			'section_btn_style',
			array(
				'label' => esc_html__( 'Style', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->register_button_style( 'add_to_cart', 'a' );
		$this->end_controls_section();
		// style icon
		$this->register_tyle_icon();
	}

	protected function register_tyle_icon() {
		// style button
		$this->start_controls_section(
			'section_btn_style_icon',
			array(
				'label'     => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display' => 'icon_tooltip',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 2,
					),
				),
				'selectors'  => array(
					'{{WRAPPER }}.hop-ekit-btn-icon_tooltip' => '--hop-ekit-icon-size: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}.hop-ekit-btn-icon_tooltip' => '--hop-ekit-icon-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'icon_color_hover',
			array(
				'label'     => esc_html__( 'Icon Color Hover', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}}' => '--hop-ekit-icon-color-hover: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'heading_tooltip_style',
			array(
				'label'     => esc_html__( 'ToolTip', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tooltip_offset_orientation_h',
			array(
				'label'        => esc_html__( 'Orientation', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::CHOOSE,
				'toggle'       => false,
				'default'      => 'top',
				'options'      => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-left',
					),
					'top'   => array(
						'title' => esc_html__( 'Top', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-top',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'render_type'  => 'ui',
				'prefix_class' => 'hop-ekit-tooltip-offset-',
			)
		);
		$this->add_control(
			'tooltip_color',
			array(
				'label'     => esc_html__( 'Text color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER }}.hop-ekit-btn-icon_tooltip' => '--hop-ekit-tooltip-text-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'tooltip_bg_color',
			array(
				'label'     => esc_html__( 'Background color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER }}.hop-ekit-btn-icon_tooltip' => '--hop-ekit-tooltip-bg-color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'tooltip_font_size',
			array(
				'label'      => esc_html__( 'Font Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER }}.hop-ekit-btn-icon_tooltip ' => '--hop-ekit-tooltip-font-size: {{SIZE}}px;',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$product  = wc_get_product( false );

		if ( ! $product ) {
			return;
		}

		$args = array();
		if ( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => implode(
					' ',
					array_filter(
						array(
							'button',
							wc_wp_theme_get_element_class_name( 'button' ), // escaped in the template.
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
						)
					)
				),
				'attributes' => array(
					'data-product_id'  => $product->get_id(),
					'data-product_sku' => $product->get_sku(),
					'aria-label'       => $product->add_to_cart_description(),
					'aria-describedby' => $product->add_to_cart_aria_describedby(),
					'rel'              => 'nofollow',
				),
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

			if ( ! empty( $args['attributes']['aria-describedby'] ) ) {
				$args['attributes']['aria-describedby'] = wp_strip_all_tags( $args['attributes']['aria-describedby'] );
			}

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
			}
			if ( $settings['display'] == 'icon_tooltip' ) {
				ob_start();
				if ( $product->is_purchasable() && $product->is_in_stock() ) {
					if ( $product->is_type( 'variable' ) ) {
						Icons_Manager::render_icon( $settings['icon_select_options'], [ 'aria-hidden' => 'true' ] );
					} else {
						Icons_Manager::render_icon( $settings['icon_cart'], [ 'aria-hidden' => 'true' ] );
					}
				} else {
					Icons_Manager::render_icon( $settings['icon_read_more'], [ 'aria-hidden' => 'true' ] );
				}
 				$icon_html = ob_get_clean();

				if ( empty( $icon_html ) ) {
					$icon_html = '<i class="tk tk-shopping-cart-arrow-down"></i>';
				}
				$text_cart = $icon_html . '<span class="tooltip">' . esc_html( $product->add_to_cart_text() ) . '</span>';
			} else {
				$text_cart = esc_html( $product->add_to_cart_text() );
			}

			echo apply_filters(
				'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
				sprintf(
					'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
					esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
					isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
					$text_cart
				),
				$product, $args
			);
		}
	}
	public function render_plain_content() {
	}
}
