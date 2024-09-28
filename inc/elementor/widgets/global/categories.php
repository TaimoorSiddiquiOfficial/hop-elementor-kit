<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

use Hop_EL_Kit\Elementor;
use Hop_EL_Kit\Settings;

class Hop_Ekit_Widget_Categories extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-categories';
	}

	public function get_title() {
		return esc_html__( 'Categories', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-product-categories';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'categories',
			'list categories',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_layout',
			array(
				'label' => esc_html__( 'Hop Categories', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'layout',
			array(
				'label'   => esc_html__( 'Select Category Type', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post_cate',
				'options' => array(
					'post_cate'   => esc_html__( 'Blog Categories', 'hop-elementor-kit' ),
					'product_cat' => esc_html__( 'Product Categories', 'hop-elementor-kit' ),
				),
			)
		);

		$this->add_control(
			'show_counts',
			array(
				'label'        => esc_html__( 'Show Category Counts', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'hop-elementor-kit' ),
				'label_off'    => esc_html__( 'Hide', 'hop-elementor-kit' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'hide_empty',
			array(
				'label'        => esc_html__( 'Hide Empty Category', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'hop-elementor-kit' ),
				'label_off'    => esc_html__( 'No', 'hop-elementor-kit' ),
				'return_value' => 'false',
				'default'      => 'false',
			)
		);

		$this->end_controls_section();

		$this->register_section_style_category();

		$this->register_tab_style_counts();
	}

	protected function register_section_style_category() {
		$this->start_controls_section(
			'style_category',
			array(
				'label' => esc_html__( 'Style General', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .hop-categories-wrapper ul > li',
			)
		);

		$this->add_control(
			'cat_link_color',
			array(
				'label'     => esc_html__( 'Link Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-categories-wrapper ul > li a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'cat_link_color_hover',
			array(
				'label'     => esc_html__( 'Link Color Hover', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-categories-wrapper ul > li a:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'cat_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-categories-wrapper ul > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'cat_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-categories-wrapper ul > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_tab_style_counts() {
		$this->start_controls_section(
			'style_category_counts',
			array(
				'label' => esc_html__( 'Category Counts', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'counts_typography',
				'selector' => '{{WRAPPER}} .hop-categories-wrapper ul > li span',
			)
		);

		$this->add_control(
			'color_counts',
			array(
				'label'     => esc_html__( 'Color Counts', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-categories-wrapper ul > li span' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'cat_align',
			array(
				'label'       => esc_html__( 'Display count', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => 'unset',
				'options'     => array(
					'unset'         => array(
						'title' => esc_html__( 'Default', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-left',
					),
					'space-between' => array(
						'title' => esc_html__( 'End', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .hop-categories-wrapper ul > li' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		$settings   = $this->get_settings_for_display();
		$hide_empty = $settings['hide_empty'];

		if ( $settings['layout'] == 'post_cate' ) {
			$args = array(
				'type'       => 'post',
				'hide_empty' => $hide_empty,
				'parent'     => 0,
			);

			$categories = get_categories( $args );
		} elseif ( $settings['layout'] == 'product_cat' ) {
			$orderby  = 'name';
			$order    = 'asc';
			$cat_args = array(
				'orderby'    => $orderby,
				'order'      => $order,
				'hide_empty' => $hide_empty,
			);

			$categories = get_terms( 'product_cat', $cat_args );
		}

		?>

		<div class="hop-categories-wrapper">
			<ul class="hop-categories-nav">
				<?php
				foreach ( $categories as $category ) { ?>
					<li class="hop-categories-items">
						<?php
						if ( $settings['layout'] == 'post_cate' ) { ?>
							<a href="<?php
							echo esc_url( get_term_link( $category->slug, 'category' ) ); ?>"> <?php
								echo esc_attr( $category->name ); ?> </a>
							<?php
						} elseif ( $settings['layout'] == 'product_cat' ) {
							?>
							<a href="<?php
							echo esc_url( get_term_link( $category ) ); ?>"> <?php
								echo esc_attr( $category->name ); ?> </a>
						<?php
						} ?>

						<?php
						if ( $settings['show_counts'] == 'yes' ) { ?>
							<span class="count"><?php
								echo esc_attr( $category->count ); ?></span>
						<?php
						} ?>

					</li>
				<?php
				} ?>
			</ul>
		</div>

		<?php
	}
}
