<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Hop_Ekit_Widget_Post_Info extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-post-info';
	}

	public function get_title() {
		return esc_html__( 'Post Info', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-post-info';
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
				'label' => esc_html__( 'Post Meta', 'hop-elementor-kit' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'type',
			array(
				'label'   => esc_html__( 'Type', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'author'   => esc_html__( 'Author', 'hop-elementor-kit' ),
					'date'     => esc_html__( 'Date', 'hop-elementor-kit' ),
					'time'     => esc_html__( 'Time', 'hop-elementor-kit' ),
					'comments' => esc_html__( 'Comments', 'hop-elementor-kit' ),
					'terms'    => esc_html__( 'Terms', 'hop-elementor-kit' ),
					'custom'   => esc_html__( 'Custom', 'hop-elementor-kit' ),
				),
			)
		);

		$repeater->add_control(
			'date_format',
			array(
				'label'     => esc_html__( 'Date Format', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => 'Default',
					'0'       => esc_html_x( 'March 6, 2021 (F j, Y)', 'Date Format', 'hop-elementor-kit' ),
					'1'       => '2021-03-06 (Y-m-d)',
					'2'       => '03/06/2021 (m/d/Y)',
					'3'       => '06/03/2021 (d/m/Y)',
					'custom'  => esc_html__( 'Custom', 'hop-elementor-kit' ),
				),
				'condition' => array(
					'type' => 'date',
				),
			)
		);

		$repeater->add_control(
			'custom_date_format',
			array(
				'label'       => esc_html__( 'Custom Date Format', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'F j, Y',
				'condition'   => array(
					'type'        => 'date',
					'date_format' => 'custom',
				),
				'description' => sprintf(
					esc_html__( 'Use the letters: %s', 'hop-elementor-kit' ),
					'l D d j S F m M n Y y'
				),
			)
		);

		$repeater->add_control(
			'show_avatar',
			array(
				'label'     => esc_html__( 'Avatar', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'type' => 'author',
				),
			)
		);

		$repeater->add_responsive_control(
			'author_avatar_width',
			array(
				'label'      => esc_html__( 'Avatar Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
				),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 500,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-post__info__author img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'type'        => 'author',
					'show_avatar' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'enable_link',
			array(
				'label'     => esc_html__( 'Enable Link', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => array(
					'type' => 'author',
				),
			)
		);

		$repeater->add_control(
			'time_format',
			array(
				'label'     => esc_html__( 'Time Format', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default' => 'Default',
					'0'       => '3:31 pm (g:i a)',
					'1'       => '3:31 PM (g:i A)',
					'2'       => '15:31 (H:i)',
					'custom'  => esc_html__( 'Custom', 'hop-elementor-kit' ),
				),
				'condition' => array(
					'type' => 'time',
				),
			)
		);

		$repeater->add_control(
			'custom_time_format',
			array(
				'label'       => esc_html__( 'Custom Time Format', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'g:i a',
				'placeholder' => 'g:i a',
				'condition'   => array(
					'type'        => 'time',
					'time_format' => 'custom',
				),
				'description' => sprintf( esc_html__( 'Use the letters: %s', 'hop-elementor-kit' ), 'g G H i a A' ),
			)
		);

		$repeater->add_control(
			'taxonomy',
			array(
				'label'       => esc_html__( 'Taxonomy', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => 'category',
				'options'     => array(
					'category' => esc_html__( 'Category', 'hop-elementor-kit' ),
					'post_tag' => esc_html__( 'Tag', 'hop-elementor-kit' ),
				),
				'condition'   => array(
					'type' => 'terms',
				),
			)
		);

		$repeater->add_control(
			'taxonomy_before',
			array(
				'label'       => esc_html__( 'Before', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Categories:', 'hop-elementor-kit' ),
				'condition'   => array(
					'type' => 'terms',
				),
			)
		);

		$repeater->add_control(
			'taxonomy_sep',
			array(
				'label'       => esc_html__( 'Seperate', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => ',',
				'condition'   => array(
					'type' => 'terms',
				),
			)
		);

		$repeater->add_control(
			'taxonomy_after',
			array(
				'label'     => esc_html__( 'After', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'condition' => array(
					'type' => 'terms',
				),
			)
		);

		$repeater->add_control(
			'custom_text',
			array(
				'label'       => esc_html__( 'Text', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => array(
					'type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'custom_link',
			array(
				'label'     => esc_html__( 'Custom Link', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'dynamic'   => [
					'active' => true,
				],
				'condition' => array(
					'type' => 'custom',
				),
			)
		);

		$repeater->add_control(
			'custom_url',
			array(
				'label'     => esc_html__( 'Custom URL', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::URL,
				'condition' => array(
					'type'        => 'custom',
					'custom_link' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'show_icon',
			array(
				'label'     => esc_html__( 'Show Icon', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'none'    => esc_html__( 'None', 'hop-elementor-kit' ),
					'default' => esc_html__( 'Default', 'hop-elementor-kit' ),
					'custom'  => esc_html__( 'Custom', 'hop-elementor-kit' ),
				),
				'default'   => 'none',
				'condition' => array(
					'show_avatar!' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'selected_icon',
			array(
				'label'     => esc_html__( 'Choose Icon', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => array(
					'show_icon'    => 'custom',
					'show_avatar!' => 'yes',
				),
			)
		);

		$this->add_control(
			'icon_list',
			array(
				'label'       => '',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'type'          => 'author',
						'selected_icon' => array(
							'value'   => 'far fa-user-circle',
							'library' => 'fa-regular',
						),
					),
					array(
						'type'          => 'date',
						'selected_icon' => array(
							'value'   => 'fas fa-calendar',
							'library' => 'fa-solid',
						),
					),
					array(
						'type'          => 'time',
						'selected_icon' => array(
							'value'   => 'far fa-clock',
							'library' => 'fa-regular',
						),
					),
					array(
						'type'          => 'comments',
						'selected_icon' => array(
							'value'   => 'far fa-comment-dots',
							'library' => 'fa-regular',
						),
					),
				),
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} <span style="text-transform: capitalize;">{{{ type }}}</span>',
			)
		);

		$this->end_controls_section();

		$this->register_style_controls();
	}

	protected function register_style_controls() {
		$this->start_controls_section(
			'section_style_image',
			array(
				'label' => esc_html__( 'General', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'space_between',
			array(
				'label'      => esc_html__( 'Space Between', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
				),
				'size_units' => array( '%', 'px' ),
				'range'      => array(
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-post__info' => 'column-gap: {{SIZE}}{{UNIT}}; -moz-column-gap: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'icon_align',
			array(
				'label'     => esc_html__( 'Alignment', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Start', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'End', 'hop-elementor-kit' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__info' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			array(
				'label' => esc_html__( 'Icon', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__info i'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .hop-ekit-single-post__info svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'height',
			array(
				'label'     => esc_html__( 'Size', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__info i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .hop-ekit-single-post__info svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_spacing',
			array(
				'label'     => esc_html__( 'Spacing', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'body:not(.rtl) {{WRAPPER}} .hop-ekit-single-post__info i, body:not(.rtl) {{WRAPPER}} .hop-ekit-single-post__info svg' => 'margin-right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .hop-ekit-single-post__info i, body.rtl {{WRAPPER}} .hop-ekit-single-post__info svg'             => 'margin-left: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			array(
				'label' => esc_html__( 'Text', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-post__info__content',
			)
		);

		$this->add_responsive_control(
			'text_spacing',
			array(
				'label'     => esc_html__( 'Spacing', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'body:not(.rtl) {{WRAPPER}} .hop-ekit-single-post__info__content a' => 'margin-right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .hop-ekit-single-post__info__content a'       => 'margin-left: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__info__content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'text_style_border',
				'label'    => esc_html__( 'Border', 'realpress' ),
				'selector' => '{{WRAPPER}} .hop-ekit-single-post__info__content a',
				'exclude'  => [ 'color' ],
			]
		);

		$this->start_controls_tabs( 'tabs_color_style' );

		$this->start_controls_tab(
			'tab_color_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'link_color',
			array(
				'label'     => esc_html__( 'Link Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__info__content a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bg_link_color',
			array(
				'label'     => esc_html__( 'Backgorund Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__info__content a' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'text_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__info__content a' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_color_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'link_color_hover',
			array(
				'label'     => esc_html__( 'Link Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__info__content a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'bg_link_color_hover',
			array(
				'label'     => esc_html__( 'Backgorund Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__info__content a:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'text_border_color_hover',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-single-post__info__content a:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->add_control(
			'text_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-post__info__content a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; display: inline-flex; align-items: center; justify-content: center;',
				),
			)
		);

		$this->add_control(
			'text_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-post__info__content a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-post/before-preview-query' );

		$settings = $this->get_settings_for_display();
		?>

		<div class="hop-ekit-single-post__info">
			<?php
			if ( ! empty( $settings['icon_list'] ) ) {
				foreach ( $settings['icon_list'] as $repeater_item ) {
					$this->render_item( $repeater_item );
				}
			}
			?>
		</div>

		<?php
		do_action( 'hop-ekit/modules/single-post/after-preview-query' );
	}

	protected function render_item( $repeater_item ) {
		switch ( $repeater_item['type'] ) {
			case 'author':
				$this->render_author( $repeater_item );
				break;
			case 'date':
				$this->render_date( $repeater_item );
				break;
			case 'time':
				$this->render_time( $repeater_item );
				break;
			case 'comments':
				$this->render_comments( $repeater_item );
				break;
			case 'terms':
				$this->render_terms( $repeater_item );
				break;
			case 'custom':
				$this->render_custom( $repeater_item );
				break;
		}
	}

	protected function render_custom( $repeater_item ) {
		$text        = $repeater_item['custom_text'];
		$enable_link = $repeater_item['custom_link'];
		$link        = $repeater_item['custom_url'];

		$show_icon = $repeater_item['show_icon'];
		$icon      = '';

		ob_start();
		Icons_Manager::render_icon( $repeater_item['selected_icon'], [ 'aria-hidden' => 'true' ] );
		$render_icon = ob_get_contents();
		ob_end_clean();


		if ( $show_icon === 'default' ) {
			$icon = '';
		} elseif ( $show_icon === 'custom' ) {
			$icon = $render_icon;
		}

		$link_target = $link['is_external'] ? ' target="_blank" rel="noopener noreferrer"' : '';
		?>

		<span class="hop-ekit-single-post__info__custom">
			<?php
			if ( ! empty( $icon ) ) : ?>
				<?php
				echo $icon; ?>
			<?php
			endif; ?>

			<span class="hop-ekit-single-post__info__content">
				<?php
				if ( $enable_link === 'yes' && ! empty( $link['url'] ) ) : ?>
					<a href="<?php
					echo esc_url( $link['url'] ); ?>" <?php
					echo wp_kses_post( $link_target ); ?>>
				<?php
				endif; ?>

				<?php
				echo wp_kses_post( $text ); ?>

				<?php
				if ( $enable_link === 'yes' && ! empty( $link['url'] ) ) : ?>
					</a>
				<?php
				endif; ?>
			</span>
		</span>

		<?php
	}

	protected function render_terms( $repeater_item ) {
		$taxonomy = $repeater_item['taxonomy'];

		if ( empty( $taxonomy ) ) {
			return;
		}

		$terms = get_the_term_list( '', $taxonomy, $repeater_item['taxonomy_before'], $repeater_item['taxonomy_sep'],
			$repeater_item['taxonomy_after'] );

		if ( empty( $terms ) ) {
			return;
		}

		$icon = '';

		ob_start();
		Icons_Manager::render_icon( $repeater_item['selected_icon'], [ 'aria-hidden' => 'true' ] );
		$render_icon = ob_get_contents();
		ob_end_clean();

		$show_icon = $repeater_item['show_icon'];

		if ( $show_icon === 'default' ) {
			$icon = '<i class="fa fa-tags"></i>';
		} elseif ( $show_icon === 'custom' ) {
			$icon = $render_icon;
		}
		?>

		<span class="hop-ekit-single-post__info__terms">
			<?php
			if ( ! empty( $icon ) ) : ?>
				<?php
				echo $icon; ?>
			<?php
			endif; ?>

			<span class="hop-ekit-single-post__info__content">
				<?php
				echo wp_kses_post( $terms ); ?>
			</span>
		</span>

		<?php
	}

	protected function render_comments( $repeater_item ) {
		if ( ! comments_open() ) {
			return;
		}

		$show_icon = $repeater_item['show_icon'];

		$icon = '';

		ob_start();
		Icons_Manager::render_icon( $repeater_item['selected_icon'], [ 'aria-hidden' => 'true' ] );
		$render_icon = ob_get_contents();
		ob_end_clean();


		if ( $show_icon === 'default' ) {
			$icon = '<i class="fa fa-commenting-o"></i>';
		} elseif ( $show_icon === 'custom' ) {
			$icon = $render_icon;
		}
		?>

		<span class="hop-ekit-single-post__info__comments">
			<?php
			if ( ! empty( $icon ) ) : ?>
				<?php
				echo $icon; ?>
			<?php
			endif; ?>

			<span class="hop-ekit-single-post__info__content">
				<?php
				comments_number(); ?>
			</span>
		</span>

		<?php
	}

	protected function render_time( $repeater_item ) {
		$custom_time_format = empty( $repeater_item['custom_time_format'] ) ? 'F j, Y' : $repeater_item['custom_time_format'];

		$format_options = array(
			'default' => '',
			'0'       => 'g:i a',
			'1'       => 'g:i A',
			'2'       => 'H:i',
			'custom'  => $custom_time_format,
		);

		$text = get_the_time( $format_options[ $repeater_item['time_format'] ] );

		$show_icon = $repeater_item['show_icon'];

		$icon = '';

		ob_start();
		Icons_Manager::render_icon( $repeater_item['selected_icon'], [ 'aria-hidden' => 'true' ] );
		$render_icon = ob_get_contents();
		ob_end_clean();

		if ( $show_icon === 'default' ) {
			$icon = '<i class="fa fa-clock-o"></i>';
		} elseif ( $show_icon === 'custom' ) {
			$icon = $render_icon;
		}
		?>

		<span class="hop-ekit-single-post__info__time">
			<?php
			if ( ! empty( $icon ) ) : ?>
				<?php
				echo $icon; ?>
			<?php
			endif; ?>

			<span class="hop-ekit-single-post__info__content">
				<?php
				echo esc_html( $text ); ?>
			</span>
		</span>

		<?php
	}

	protected function render_author( $repeater_item ) {
		global $post;

		$user_id = $post->post_author;

		if ( ! $user_id ) {
			return;
		}

		$user = get_userdata( $user_id );
		$text = $user->display_name;

		$show_icon = $repeater_item['show_icon'];

		$icon = '';

		ob_start();
		Icons_Manager::render_icon( $repeater_item['selected_icon'], [ 'aria-hidden' => 'true' ] );
		$render_icon = ob_get_contents();
		ob_end_clean();

		if ( $show_icon === 'default' ) {
			$icon = '<i class="fa fa-user-circle-o"></i>';
		} elseif ( $show_icon === 'custom' ) {
			$icon = $render_icon;
		}

		$tag_name  = 'span';
		$tag_attrs = ' class="hop-ekit-single-post__info__author"';

		$url = get_author_posts_url( $user_id );

		if ( $repeater_item['enable_link'] ) {
			$tag_name  = 'a';
			$tag_attrs = ' class="hop-ekit-single-post__info__author" href="' . esc_url( $url ) . '"';
		}

		$avatar = get_avatar_url( $user_id, 96 );
		?>

		<<?php
		echo esc_html( $tag_name ) . wp_kses_post( $tag_attrs ); ?>>
		<?php
		if ( $repeater_item['show_avatar'] ) : ?>
			<span><img src="<?php
				echo esc_url( $avatar ); ?>" alt="<?php
				echo esc_attr( $user->display_name ); ?>"></span>
		<?php
		elseif ( ! empty( $icon ) ) : ?>
			<?php
			echo $icon; ?>
		<?php
		endif; ?>

		<span class="hop-ekit-single-post__info__content">
				<?php
				echo esc_html( $user->display_name ); ?>
			</span>
		</<?php
		echo esc_html( $tag_name ); ?>>

		<?php
	}

	protected function render_date( $repeater_item ) {
		$custom_date_format = empty( $repeater_item['custom_date_format'] ) ? 'F j, Y' : $repeater_item['custom_date_format'];

		$format_options = array(
			'default' => '',
			'0'       => 'F j, Y',
			'1'       => 'Y-m-d',
			'2'       => 'm/d/Y',
			'3'       => 'd/m/Y',
			'custom'  => $custom_date_format,
		);

		$text = get_the_date( $format_options[ $repeater_item['date_format'] ] );

		$show_icon = $repeater_item['show_icon'];

		$icon = '';

		ob_start();
		Icons_Manager::render_icon( $repeater_item['selected_icon'], [ 'aria-hidden' => 'true' ] );
		$render_icon = ob_get_contents();
		ob_end_clean();

		if ( $show_icon === 'default' ) {
			$icon = '<i class="fa fa-calendar-o"></i>';
		} elseif ( $show_icon === 'custom' ) {
			$icon = $render_icon;
		}
		?>

		<span class="hop-ekit-single-post__info__date">
			<?php
			if ( ! empty( $icon ) ) : ?>
				<?php
				echo $icon; ?>
			<?php
			endif; ?>

			<span class="hop-ekit-single-post__info__content">
				<?php
				echo esc_html( $text ); ?>
			</span>
		</span>

		<?php
	}
}
