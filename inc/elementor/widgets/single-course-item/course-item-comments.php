<?php

namespace Elementor;

if ( ! class_exists( 'Hop_Ekit_Widget_Post_Comment' ) ) {
	require_once HOP_EKIT_PLUGIN_PATH . 'inc/elementor/widgets/single-post/post-comment.php';
}

class Hop_Ekit_Widget_Course_Item_Comments extends Hop_Ekit_Widget_Post_Comment {
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
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE_ITEM );
	}

	public function render() {
		$item = \LP_Global::course_item();
		if ( ! $item ) {
			return;
		}
		if ( $item->setup_postdata() ) {
			if ( comments_open() || get_comments_number() ) {
				echo '<div class="hop-ekit-single-post__comment">';
				add_filter( 'deprecated_file_trigger_error', '__return_false' );
				comments_template();
				remove_filter( 'deprecated_file_trigger_error', '__return_false' );
				echo '</div>';
			}
			$item->reset_postdata();
		}
	}
}
