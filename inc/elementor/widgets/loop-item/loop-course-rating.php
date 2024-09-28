<?php

namespace Elementor;

use Hop_EL_Kit\Utilities\Widget_Loop_Trait;

if ( ! class_exists( '\Elementor\Hop_Ekit_Widget_Course_Rating' ) ) {
	include HOP_EKIT_PLUGIN_PATH . 'inc/elementor/widgets/single-course/course-rating.php';
}


class Hop_Ekit_Widget_Loop_Course_Rating extends Hop_Ekit_Widget_Course_Rating {

	use Widget_Loop_Trait;

    public function __construct( $data = array(), $args = null ) { 
		parent::__construct( $data, $args );
	}

    public function get_name() {
		return 'hop-loop-course-rating';
	}

	public function show_in_panel() {
		$post_type = get_post_meta( get_the_ID(), 'hop_loop_item_post_type', true );
		if ( ! empty( $post_type ) && $post_type == 'lp_course' ) {
			return true;
		}

		return false;
	}

	public function get_title() {
		return esc_html__( 'Item Course Rating', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-rating';
	}

	public function get_keywords() {
		return array( 'course', 'ratting' );
	}
}