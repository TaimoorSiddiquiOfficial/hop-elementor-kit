<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Controls\Repeater as Global_Style_Repeater;
use Elementor\Utils;
use Hop_EL_Kit\GroupControlTrait;

class Hop_Ekit_Widget_Post_Related extends Hop_Ekit_Widget_List_Base {
	use GroupControlTrait;

	protected $current_permalink;


	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-post-related';
	}

	public function get_title() {
		return esc_html__( 'Post Related', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-post-content';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_POST );
	}

	public function get_help_url() {
		return '';
	}

	public function get_keywords() {
		return [
			'hop',
			'blog',
			'list blog',
			'blogs',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content_list',
			array(
				'label' => esc_html__( 'Blog Settings', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'blog_layout',
			array(
				'label'   => esc_html__( 'Select Layout', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => esc_html__( 'Default', 'hop-elementor-kit' ),
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
							   ) + \Hop_EL_Kit\Functions::instance()->get_pages_loop_item( 'post' ),
				'condition' => array(
					'build_loop_item' => 'yes',
				),
			)
		);
		$this->add_control(
			'related_by',
			array(
				'label'   => esc_html__( 'Related By', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => array(
					'category' => esc_html__( 'Category', 'hop-elementor-kit' ),
					'tags'     => esc_html__( 'Tags', 'hop-elementor-kit' ),
				),
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
				),
				'selectors'      => array(
					'{{WRAPPER}}' => '--hop-ekits-post-columns: repeat({{VALUE}}, 1fr)',
				),
				'condition'      => array(
					'blog_layout!' => 'slider',
				),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => esc_html__( 'Order by', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'popular' => esc_html__( 'Popular', 'hop-elementor-kit' ),
					'recent'  => esc_html__( 'Date', 'hop-elementor-kit' ),
					'title'   => esc_html__( 'Title', 'hop-elementor-kit' ),
					'random'  => esc_html__( 'Random', 'hop-elementor-kit' ),
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

		$this->end_controls_section();
		$this->_register_style_layout();

		parent::register_controls();

		$this->_register_settings_slider(
			array(
				'blog_layout' => 'slider',
			)
		);

		$this->_register_setting_slider_dot_style(
			array(
				'blog_layout'             => 'slider',
				'slider_show_pagination!' => 'none',
			)
		);

		$this->_register_setting_slider_nav_style(
			array(
				'blog_layout'       => 'slider',
				'slider_show_arrow' => 'yes',
			)
		);
	}

	protected function _register_style_layout() {
		$this->start_controls_section(
			'section_design_layout',
			array(
				'label'     => esc_html__( 'Layout', 'hop-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'blog_layout!' => 'slider',
				),
			)
		);

		$this->add_responsive_control(
			'column_gap',
			array(
				'label'     => esc_html__( 'Columns Gap', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 30,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}}' => '--hop-ekits-post-column-gap: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'row_gap',
			array(
				'label'     => esc_html__( 'Rows Gap', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 35,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}}' => '--hop-ekits-post-row-gap: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->get_settings_for_display();

		$query_args = array(
			'post_type'           => 'post',
			'posts_per_page'      => absint( $settings['number_posts'] ),
			'order'               => ( 'asc' == $settings['order'] ) ? 'asc' : 'desc',
			'ignore_sticky_posts' => true,
			'post__not_in'        => array( get_the_ID() ),
			'category__in'        => wp_get_post_categories( get_the_ID() )
		);
		if ( $settings['related_by'] == 'tags' ) {
			$tags = wp_get_post_tags( get_the_ID() );
			if ( $tags ) {
				$query_args['tag__in'] = array( $tags[0]->term_id );
			} else {
				// get category if not have tags
				$query_args['category__in'] = wp_get_post_categories( get_the_ID() );
			}
		} else {
			$query_args['category__in'] = wp_get_post_categories( get_the_ID() );
		}

		switch ( $settings['orderby'] ) {
			case 'recent':
				$query_args['orderby'] = 'post_date';
				break;
			case 'title':
				$query_args['orderby'] = 'post_title';
				break;
			case 'popular':
				$query_args['orderby'] = 'comment_count';
				break;
			default: // random
				$query_args['orderby'] = 'rand';
		}
		$query_vars = new \WP_Query( $query_args );

		$class       = 'hop-ekits-post';
		$class_inner = 'hop-ekits-post__inner';
		$class_item  = 'hop-ekits-post__article';

		if ( $query_vars->have_posts() ) { // It's the global `wp_query` it self. and the loop was started from the theme.
			if ( isset( $settings['blog_layout'] ) && $settings['blog_layout'] == 'slider' ) {
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
					while ( $query_vars->have_posts() ) {
						$query_vars->the_post();
						$this->current_permalink = get_permalink();
						parent::render_post( $settings, $class_item );
					}
					?>
				</div>
			</div>

			<?php
		}
		wp_reset_postdata();
	}
}
