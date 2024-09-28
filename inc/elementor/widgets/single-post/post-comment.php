<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Post_Comment extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-post-comment';
	}

	public function get_title() {
		return esc_html__( 'Post Comment', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-comments';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_POST );
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
			'skin_temp',
			array(
				'label'   => esc_html__( 'Skin', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Theme Comments', 'hop-elementor-kit' ),
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-post/before-preview-query' );


		if ( comments_open() || '0' != get_comments_number() ) :
			?>

			<div class="hop-ekit-single-post__comment">
				<?php
				comments_template(); ?>
			</div>

		<?php
		endif;
		do_action( 'hop-ekit/modules/single-post/after-preview-query' );
	}
}
