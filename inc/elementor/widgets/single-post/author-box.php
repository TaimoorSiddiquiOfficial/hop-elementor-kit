<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Author_Box extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-author-box';
	}

	public function get_title() {
		return esc_html__( 'Author Box', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-person';
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
				'label' => esc_html__( 'Author Box', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'show_avatar',
			array(
				'label'       => esc_html__( 'Show Avatar', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Show', 'hop-elementor-kit' ),
				'label_off'   => esc_html__( 'Hide', 'hop-elementor-kit' ),
				'default'     => 'yes',
				'separator'   => 'before',
				'render_type' => 'template',
			)
		);

		$this->add_control(
			'show_name',
			array(
				'label'       => esc_html__( 'Display Name', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Show', 'hop-elementor-kit' ),
				'label_off'   => esc_html__( 'Hide', 'hop-elementor-kit' ),
				'default'     => 'yes',
				'render_type' => 'template',
			)
		);

		$this->add_control(
			'author_name_tag',
			array(
				'label'   => esc_html__( 'Author Name Tag', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
				),
				'default' => 'h4',
			)
		);

		$this->add_control(
			'link_to',
			array(
				'label'       => esc_html__( 'Link', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					''              => esc_html__( 'None', 'hop-elementor-kit' ),
					'website'       => esc_html__( 'Website', 'hop-elementor-kit' ),
					'posts_archive' => esc_html__( 'All Posts by Author', 'hop-elementor-kit' ),
					'custom'        => esc_html__( 'Custom', 'hop-elementor-kit' ),
				),
				'description' => esc_html__( 'Link for the Author Name and Image', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'author_link',
			array(
				'label'       => esc_html__( 'Link', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'hop-elementor-kit' ),
				'condition'   => array(
					'link_to' => 'custom',
				),
				'description' => esc_html__( 'Link for the Author Name and Image', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'show_biography',
			array(
				'label'       => esc_html__( 'Biography', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'    => esc_html__( 'Show', 'hop-elementor-kit' ),
				'label_off'   => esc_html__( 'Hide', 'hop-elementor-kit' ),
				'default'     => 'yes',
				'render_type' => 'template',
			)
		);

		$this->add_control(
			'avatar_position',
			array(
				'label'        => esc_html__( 'Avatar Position', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::CHOOSE,
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
				'separator'    => 'before',
				'prefix_class' => 'hop-ekit-single-post__author-box--avatar-position-',
			)
		);

		$this->add_control(
			'alignment',
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
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__author-box' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->register_style_controls();
	}

	protected function register_style_controls() {
		$this->start_controls_section(
			'section_style_author_box',
			array(
				'label' => esc_html__( 'Image', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'image_size',
			array(
				'label'     => esc_html__( 'Image Size', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__author-box img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'image_gap',
			array(
				'label'     => esc_html__( 'Gap', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}}.hop-ekit-single-post__author-box--avatar-position-left .hop-ekit-single-post__author-box,
					{{WRAPPER}}.hop-ekit-single-post__author-box--avatar-position-right .hop-ekit-single-post__author-box' => 'column-gap: {{SIZE}}{{UNIT}};',

					'{{WRAPPER}}.hop-ekit-single-post__author-box--avatar-position-top .hop-ekit-single-post__author-box__avatar' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .hop-ekit-single-post__author-box__avatar img',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-post__author-box__avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .hop-ekit-single-post__author-box__avatar img',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			array(
				'label' => esc_html__( 'Text', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'heading_name_style',
			array(
				'label'     => esc_html__( 'Author Name', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__author-box__content__title_inner' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-post__author-box__content__title_inner',
			)
		);

		$this->add_responsive_control(
			'name_gap',
			array(
				'label'     => esc_html__( 'Gap', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__author-box__content__title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'heading_bio_style',
			array(
				'label'     => esc_html__( 'Biography', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'bio_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__author-box__content__bio' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'bio_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-post__author-box__content__bio',
			)
		);

		$this->add_responsive_control(
			'bio_gap',
			array(
				'label'     => esc_html__( 'Gap', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__author-box__content__bio' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-post/before-preview-query' );

		$settings = $this->get_settings_for_display();

		global $post;

		$user_id = $post->post_author;

		$avatar_args['size'] = 300;

		$user = get_userdata( $user_id );

		$author['avatar']       = get_avatar_url( $user_id, $avatar_args );
		$author['display_name'] = $user->display_name;
		$author['website']      = $user->user_url;
		$author['bio']          = $user->description;
		$author['posts_url']    = get_author_posts_url( $user_id );

		$show_avatar    = $settings['show_avatar'] === 'yes' && ! empty( $author['avatar'] );
		$show_name      = $settings['show_name'] === 'yes' && ! empty( $author['display_name'] );
		$show_biography = $settings['show_biography'] === 'yes' && ! empty( $author['bio'] );

		$link      = $settings['link_to'];
		$link_tag  = 'span';
		$link_attr = '';

		if ( $link !== '' ) {
			$link_tag = 'a';

			if ( $link === 'website' ) {
				$link_attr = ' href="' . esc_url( $author['website'] ) . '"';
			} elseif ( $link === 'posts_archive' ) {
				$link_attr = ' href="' . esc_url( $author['posts_url'] ) . '"';
			} elseif ( $link === 'custom' ) {
				$link_target = $settings['author_link']['is_external'] ? ' target="_blank" rel="noopener noreferrer"' : '';
				$link_attr   = ' href="' . esc_url( $settings['author_link']['url'] ) . '"' . wp_kses_post( $link_target ) . ' ';
			}
		}
		?>

		<div class="hop-ekit-single-post__author-box">
			<?php
			if ( $show_avatar ) : ?>
				<div class="hop-ekit-single-post__author-box__avatar">
					<?php
					echo '<' . esc_html( $link_tag ) . wp_kses_post( $link_attr ) . '>'; ?>
					<img src="<?php
					echo esc_url( $author['avatar'] ); ?>" alt="<?php
					echo esc_attr( $author['display_name'] ); ?>">
					<?php
					echo '</' . esc_html( $link_tag ) . '>'; ?>
				</div>
			<?php
			endif; ?>

			<div class="hop-ekit-single-post__author-box__content">
				<?php
				if ( $show_name ) : ?>
					<?php
					echo '<' . Utils::validate_html_tag( $settings['author_name_tag'] ) . ' class="hop-ekit-single-post__author-box__content__title">'; ?>
					<?php
					echo '<' . esc_html( $link_tag ) . wp_kses_post( $link_attr ) . ' class="hop-ekit-single-post__author-box__content__title_inner">'; ?>
					<?php
					echo esc_html( $author['display_name'] ); ?>
					<?php
					echo '</' . esc_html( $link_tag ) . '>'; ?>
					<?php
					echo '</' . Utils::validate_html_tag( $settings['author_name_tag'] ) . '>'; ?>
				<?php
				endif; ?>

				<?php
				if ( $show_biography ) : ?>
					<div class="hop-ekit-single-post__author-box__content__bio">
						<?php
						echo esc_html( $author['bio'] ); ?>
					</div>
				<?php
				endif; ?>
			</div>
		</div>

		<?php
		do_action( 'hop-ekit/modules/single-post/after-preview-query' );
	}
}
