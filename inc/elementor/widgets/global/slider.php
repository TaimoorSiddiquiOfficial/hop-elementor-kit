<?php

namespace Elementor;

use Elementor\Plugin;
use Hop_EL_Kit\GroupControlTrait;

class Hop_Ekit_Widget_Slider extends Widget_Base {
	use GroupControlTrait;

	public function get_name() {
		return 'hop-ekits-slider';
	}

	public function get_title() {
		return esc_html__( 'Slider', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-slider-3d';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'tab',
			'tabs',
		];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'setting',
			[
				'label' => esc_html__( 'General', 'hop-elementor-kit' ),
			]
		);

		$this->add_control(
			'slider_id',
			[
				'label'       => __( 'Slider', 'hop-elementor-kit' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => false,
				'options'     => \Hop_EL_Kit\Elementor::get_cat_taxonomy( 'hop_ekits_slider', false, false ),
				'default'     => 'choose',
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->_register_settings_slider( null, true );

		$this->_register_setting_slider_dot_style();

		$this->_register_setting_slider_nav_style();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['slider_id'] ) ) {
			return;
		}

		$query_args = array(
			'post_type'           => 'hop_ekits_slide',
			'posts_per_page'      => - 1,
			'orderby'             => 'menu_order',
			'order'               => 'ASC',
			'ignore_sticky_posts' => true,
		);

		if ( is_numeric( $settings['slider_id'] ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'hop_ekits_slider',
					'field'    => 'term_id',
					'terms'    => $settings['slider_id'],
				)
			);
		} else {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'hop_ekits_slider',
					'field'    => 'slug',
					'terms'    => $settings['slider_id'],
				)
			);
		}

		$slides = get_posts( $query_args );

		if ( is_wp_error( $slides ) || empty( $slides ) ) {
			return;
		}

		$this->render_nav_pagination_slider( $settings );
		$swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';
		$class        = 'hop-ekits-sliders ' . $swiper_class;
		?>

		<div class="<?php
		echo esc_attr( $class ); ?>">
			<div class="swiper-wrapper">
				<?php
				foreach ( $slides as $slide ) :
					echo '<div class="swiper-slide">';
					echo \Hop_EL_Kit\Utilities\Elementor::instance()->render_content( $slide->ID );
					echo '</div>';
				endforeach;
				?>
			</div>
		</div>

		<?php
	}
}
