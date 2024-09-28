<?php

namespace Elementor;

// use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Hop_EL_Kit\GroupControlTrait;
use Hop_EL_Kit\Elementor\Controls\Controls_Manager as Hop_Control_Manager;

if ( ! class_exists( '\Elementor\Hop_Ekits_Course_Base' ) ) {
	include HOP_EKIT_PLUGIN_PATH . 'inc/elementor/widgets/global/course-base.php';
}

class Hop_Ekit_Widget_List_Course extends Hop_Ekits_Course_Base {
	use GroupControlTrait;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-list-course';
	}

	public function get_title() {
		return esc_html__( 'List Course', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-archive-posts';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'course',
			'list course',
			'courses',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_layout',
			array(
				'label' => esc_html__( 'Options', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'course_skin',
			array(
				'label'   => esc_html__( 'Skin', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => esc_html__( 'Default', 'hop-elementor-kit' ),
					'tab'     => esc_html__( 'Tab', 'hop-elementor-kit' ),
					'slider'  => esc_html__( 'Slider', 'hop-elementor-kit' ),
				),
			)
		);
		$this->add_control(
			'build_loop_item',
			array(
				'label'     => esc_html__( 'Build Loop Item', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'template_id',
			array(
				'label'     => esc_html__( 'Choose a template', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT2,
				'default'   => '0',
				'options'   => array(
								   '0' => esc_html__( 'None', 'hop-elementor-kit' )
							   ) + \Hop_EL_Kit\Functions::instance()->get_pages_loop_item( 'lp_course' ),
				//				'frontend_available' => true,
				'condition' => array(
					'build_loop_item' => 'yes',
				),
			)
		);

		$this->add_control(
			'cat_id',
			array(
				'label'    => esc_html__( 'Select Category', 'hop-elementor-kit' ),
				'type'     => Hop_Control_Manager::SELECT2,
				'multiple' => true,
				'options'  => \Hop_EL_Kit\Elementor::get_cat_taxonomy( 'course_category' ),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => esc_html__( 'Order by', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'recent' => esc_html__( 'Date', 'hop-elementor-kit' ),
					'title'  => esc_html__( 'Title', 'hop-elementor-kit' ),
					'random' => esc_html__( 'Random', 'hop-elementor-kit' ),
				),
				'default' => 'recent',
			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => esc_html__( 'Order by', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'asc'  => esc_html__( 'ASC', 'hop-elementor-kit' ),
					'desc' => esc_html__( 'DESC', 'hop-elementor-kit' ),
				),
				'default' => 'asc',
			)
		);

		$this->add_control(
			'number_posts',
			array(
				'label'   => esc_html__( 'Number Post', 'hop-elementor-kit' ),
				'default' => '4',
				'type'    => Controls_Manager::NUMBER,
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => esc_html__( 'Columns', 'hop-elementor-kit' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
				'selectors'      => array(
					'{{WRAPPER}}' => '--hop-ekits-course-columns: repeat({{VALUE}}, 1fr)',
				),
				'condition'      => array(
					'course_skin' => array( 'default', 'tab' ),
				),
			)
		);

		$this->end_controls_section();

		parent::register_controls();

		//		$this->_register_style_layout();

		$this->_register_settings_slider(
			array(
				'course_skin' => 'slider',
			)
		);

		$this->_register_style_course_tab();

		$this->_register_setting_slider_dot_style(
			array(
				'course_skin'             => 'slider',
				'slider_show_pagination!' => 'none',
			)
		);

		$this->_register_setting_slider_nav_style(
			array(
				'course_skin'       => 'slider',
				'slider_show_arrow' => 'yes',
			)
		);
	}

	protected function _register_style_course_tab() {
		$this->start_controls_section(
			'section_style_course_tab',
			array(
				'label'     => esc_html__( 'Course Tab', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'course_skin' => 'tab',
				),
			)
		);

		$this->add_responsive_control(
			'course_tab_align',
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
				'default'   => 'right',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .hop-course-tabs .nav-tabs' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'course_tab_item_spacing',
			array(
				'label'     => esc_html__( 'Spacing', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 120,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-course-tabs .nav-tabs' => 'margin: 0 0 {{SIZE}}{{UNIT}} 0',
				),
				'default'   => array(
					'size' => 80,
				),
			)
		);

		$this->add_responsive_control(
			'course_tab_item_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 50,
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-course-tabs .nav-tabs li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'course_tab_item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'default'    => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 10,
					'left'   => 0,
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-course-tabs .nav-tabs li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// start tab for content
		$this->start_controls_tabs(
			'course_style_tabs_item'
		);

		// start normal tab
		$this->start_controls_tab(
			'tab_item_style_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'tab_item_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .hop-course-tabs .nav-tabs li a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tab_item_bg',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-course-tabs .nav-tabs li a' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tab_item_border',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-course-tabs .nav-tabs li a',
			)
		);

		$this->end_controls_tab();
		// end normal tab

		// start active tab
		$this->start_controls_tab(
			'tab_item_style_active',
			array(
				'label' => esc_html__( 'Active', 'hop-elementor-kit' ),
			)
		);
		$this->add_control(
			'tab_item_text_color_active',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .hop-course-tabs .nav-tabs li a:hover,{{WRAPPER}} .hop-course-tabs .nav-tabs li.active a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tab_item_bg_hover',
			array(
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-course-tabs .nav-tabs li a:hover,{{WRAPPER}} .hop-course-tabs .nav-tabs li.active a' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tab_item_border_active',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-course-tabs .nav-tabs li a:hover,{{WRAPPER}} .hop-course-tabs .nav-tabs li.active a',
			)
		);

		$this->end_controls_tab();
		// end hover tab

		$this->end_controls_tabs();

		$this->add_control(
			'tab_item_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-course-tabs .nav-tabs li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tab_item_typography',
				'label'    => esc_html__( 'Typography', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-course-tabs .nav-tabs li a',
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		$settings   = $this->get_settings_for_display();
		$query_args = array(
			'post_type'           => 'lp_course',
			'posts_per_page'      => $settings['number_posts'],
			'order'               => ( 'asc' == $settings['order'] ) ? 'asc' : 'desc',
			'ignore_sticky_posts' => true,
			'post_status'         => 'publish',
		);

		switch ( $settings['orderby'] ) {
			case 'recent':
				$query_args['orderby'] = 'post_date';
				break;
			case 'title':
				$query_args['orderby'] = 'post_title';
				break;
			default: // random
				$query_args['orderby'] = 'rand';
		}

		if ( $settings['course_skin'] == 'tab' ) {
			$this->render_course_tab( $settings, $query_args );
		} else {
			if ( $settings['cat_id'] ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'course_category',
						'field'    => 'term_id',
						'terms'    => $settings['cat_id'],
					),
				);
			}

			$the_query   = new \WP_Query( $query_args );
			$class       = 'hop-ekits-course';
			$class_inner = 'hop-ekits-course__inner';
			$class_item  = 'hop-ekits-course__item';

			if ( $the_query->have_posts() ) {
				if ( isset( $settings['course_skin'] ) && $settings['course_skin'] == 'slider' ) {
					$swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';
					$class        .= ' hop-ekits-sliders ' . $swiper_class;
					$class_inner  = 'swiper-wrapper';
					$class_item   .= ' swiper-slide';

					$this->render_nav_pagination_slider( $settings );
				}
				?>
				<div class="<?php
				echo esc_attr( $class ); ?>">
					<div class="<?php
					echo esc_attr( $class_inner ); ?>">
						<?php
						while ( $the_query->have_posts() ) {
							$the_query->the_post();
							parent::render_course( $settings, $class_item );
						}
						?>
					</div>
				</div>
				<?php
			} else {
				echo '<div class="message-info">' . __( 'No data were found matching your selection, you need to create Post or select Category of Widget.',
						'hop-elementor-kit' ) . '</div>';
			}

			wp_reset_postdata();
		}
	}

	public function render_course_tab( $settings, $query_args ) {
		$params   = array(
			'page_id'   => esc_attr(get_the_id()),
			'widget_id' => esc_attr($this->get_id()),
		);
		$list_tab = '';
		if ( $settings['cat_id'] ) {
			$cat_ids = $settings['cat_id'];
		} else {
			$cat_ids         = array();
			$all_product_cat = get_terms(
				'course_category',
				array(
					'hide_empty' => false,
					'number'     => 4,
				)
			);
			if ( ! is_wp_error( $all_product_cat ) ) {
				foreach ( $all_product_cat as $cat_id_df ) {
					$cat_ids[] = esc_attr( $cat_id_df->term_id );
				}
			}
		}

		echo '<div class="hop-course-tabs hop-block-tabs" data-params="' . htmlentities( json_encode( $params ) ) . '">';
		if ( $cat_ids ) {
			$cat_default_active = $cat_ids;
			foreach ( $cat_ids as $k => $tab ) {
				$term = get_term_by( 'id', $tab, 'course_category' );
				if ( $term ) {
					$tab_class = ' class="cat-item"';
					if ( $k == 0 ) {
						$tab_class          = ' class="cat-item active"';
						$cat_default_active = $term->term_id;
					}
					$list_tab .= '<li' . $tab_class . '><a data-cat="' . $term->term_id . '" href="#">' . esc_html( $term->name ) . '</a></li>';
				}
			}
			// show html tab
			if ( $list_tab ) {
				echo '<ul class="nav nav-tabs">' . wp_kses_post( $list_tab ) . '</ul>';
			}

			// render content
			echo '<div class="loop-wrapper hop-ekits-course">';

			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'course_category',
					'field'    => 'term_id',
					'terms'    => $cat_default_active,
				),
			);
			$this->render_data_content_tab( $settings, $cat_default_active );
			echo '</div>';
		}
		echo '</div>';
	}

	public function render_data_content_tab( $settings, $cat_id ) {
		$query_args = array(
			'post_type'           => 'lp_course',
			'posts_per_page'      => $settings['number_posts'],
			'order'               => ( 'asc' == $settings['order'] ) ? 'asc' : 'desc',
			'ignore_sticky_posts' => true,
			'post_status'         => 'publish',
		);

		switch ( $settings['orderby'] ) {
			case 'recent':
				$query_args['orderby'] = 'post_date';
				break;
			case 'title':
				$query_args['orderby'] = 'post_title';
				break;
			default: // random
				$query_args['orderby'] = 'rand';
		}
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => 'course_category',
				'field'    => 'term_id',
				'terms'    => $cat_id,
			),
		);

		$the_query = new \WP_Query( $query_args );

		if ( $the_query->have_posts() ) {
			?>
			<div class="hop-ekits-course__inner">
				<?php
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					parent::render_course( $settings, 'hop-ekits-course__item' );
				}
				?>
			</div>
			<?php
		} else {
			echo '<div class="message-info">' . esc_html__( 'No data were found matching your selection, you need to create Post or select Category of Widget.',
					'hop-elementor-kit' ) . '</div>';
		}

		wp_reset_postdata();
	}

}
