<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

if ( ! class_exists( 'Hop_Ekit_Widget_Post_Comment' ) ) {
	require_once HOP_EKIT_PLUGIN_PATH . 'inc/elementor/widgets/single-post/post-comment.php';
}

class Hop_Ekit_Widget_Course_Comment extends Hop_Ekit_Widget_Post_Comment {
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-course-comment';
	}

	public function get_title() {
		return esc_html__( 'Course Comment', 'hop-elementor-kit' );
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE );
	}

}
