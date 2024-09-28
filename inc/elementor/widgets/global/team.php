<?php

namespace Elementor;

// Exit if accessed directly
use Hop_EL_Kit\GroupControlTrait;
use Hop_EL_Kit\Elementor\Controls\Controls_Manager as Hop_Control_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hop_Ekit_Widget_Team extends Widget_Base {
	use GroupControlTrait;

	public function get_name() {
		return 'hop-ekits-team';
	}

	public function get_title() {
		return esc_html__( 'Team', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-image-box';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'hop',
			'team',
			'member',
			'teams',
		];
	}

	public function get_base() {
		return basename( __FILE__, '.php' );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Our Team', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'team_layout',
			array(
				'label'        => esc_html__( 'Select Layout', 'hop-elementor-kit' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'default',
				'options'      => array(
					'default' => esc_html__( 'Default', 'hop-elementor-kit' ),
					'slider'  => esc_html__( 'Slider', 'hop-elementor-kit' ),
				),
				'prefix_class' => 'hop-ekit-team-',
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'     => esc_html__( 'Columns', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'selectors' => array(
					'{{WRAPPER}}' => '--hop-ekits-team-columns: repeat({{VALUE}}, 1fr)',
				),
				'condition' => array(
					'team_layout' => 'default',
				),
			)
		);

		$this->add_control(
			'enable_link_member',
			array(
				'label'   => esc_html__( 'Enable Link To Member?', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$this->add_control(
			'link_member',
			array(
				'label'         => esc_html__( 'Member Link', 'hop-elementor-kit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'hop-elementor-kit' ),
				'show_external' => false,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'enable_link_member' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'         => 'thumbnail_size',
				'default'      => 'medium',
				'prefix_class' => 'hop-ekits-posts--thumbnail-size-',
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'member_image',
			array(
				'label'   => esc_html__( 'Choose Member Image', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
					'id'  => - 1,
				),
			)
		);

		$repeater->add_control(
			'member_name',
			array(
				'label'       => esc_html__( 'Member Name', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Jane Doe', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'Member Name', 'hop-elementor-kit' ),
			)
		);

		$repeater->add_control(
			'member_position',
			array(
				'label'       => esc_html__( 'Member Position', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Designer', 'hop-elementor-kit' ),
				'placeholder' => esc_html__( 'Member Position', 'hop-elementor-kit' ),

			)
		);

		$repeater->add_control(
			'member_description',
			array(
				'label'   => esc_html__( 'Member Description', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'I came to Eduma ten years ago. I really enjoy teaching here as it’s...',
					'hop-elementor-kit' ),

			)
		);

		$repeater->add_control(
			'icon_data',
			array(
				'label'       => esc_html__( 'Icon Data', 'hop-elementor-kit' ),
				'label_block' => true,
				'type'        => Hop_Control_Manager::SELECT2,
				'default'     => array( 'facebook', 'youtube' ),
				'multiple'    => true,
				'options'     => array(
					'facebook'  => esc_html__( 'FaceBook', 'hop-elementor-kit' ),
					'twitter'   => esc_html__( 'Twitter', 'hop-elementor-kit' ),
					'youtube'   => esc_html__( 'Youtube', 'hop-elementor-kit' ),
					'linked_in' => esc_html__( 'Linked In', 'hop-elementor-kit' ),
				),
			)
		);

		$repeater->add_control(
			'facebook_link',
			array(
				'label'         => esc_html__( 'Facebook Link', 'hop-elementor-kit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'hop-elementor-kit' ),
				'show_external' => false,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'icon_data' => 'facebook',
				),
			)
		);

		$repeater->add_control(
			'twitter_link',
			array(
				'label'         => esc_html__( 'Twitter Link', 'hop-elementor-kit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'hop-elementor-kit' ),
				'show_external' => false,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'icon_data' => 'twitter',
				),
			)
		);

		$repeater->add_control(
			'youtube_link',
			array(
				'label'         => esc_html__( 'Youtube Link', 'hop-elementor-kit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'hop-elementor-kit' ),
				'show_external' => false,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'icon_data' => 'youtube',
				),
			)
		);

		$repeater->add_control(
			'linked_in_link',
			array(
				'label'         => esc_html__( 'Linked In Link', 'hop-elementor-kit' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'hop-elementor-kit' ),
				'show_external' => false,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'icon_data' => 'linked_in',
				),
			)
		);

		$repeater->add_control(
			'show_rating',
			array(
				'label'   => esc_html__( 'Show Rating?', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
			)
		);

		$repeater->add_control(
			'rating',
			array(
				'label'       => esc_html__( 'Rating', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '5',
				'options'     => array(
					'5' => esc_html__( '5', 'hop-elementor-kit' ),
					'4' => esc_html__( '4', 'hop-elementor-kit' ),
					'3' => esc_html__( '3', 'hop-elementor-kit' ),
					'2' => esc_html__( '2', 'hop-elementor-kit' ),
					'1' => esc_html__( '1', 'hop-elementor-kit' ),
				),
				'label_block' => true,
				'condition'   => array(
					'show_rating' => 'yes',
				),
			)
		);

		$this->add_control(
			'repeater',
			array(
				'label'       => esc_html__( 'List Member', 'hop-elementor-kit' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'member_name' => esc_html__( 'Jane Doe', 'hop-elementor-kit' ),
					),
					array(
						'member_name' => esc_html__( 'Stevan kate', 'hop-elementor-kit' ),
					),
					array(
						'member_name' => esc_html__( 'Hander Ronay', 'hop-elementor-kit' ),
					),
				),
				'title_field' => '{{{ member_name }}}',
			)
		);

		$this->end_controls_section();

		$this->_register_settings_slider(
			array(
				'team_layout' => 'slider',
			)
		);
		$this->register_style_layout();
		$this->register_style_image();
		$this->register_style_name();
		$this->register_style_position();
		$this->register_style_description();
		$this->register_style_rating();
		$this->register_style_social();
		$this->_register_setting_slider_dot_style();
		$this->_register_setting_slider_nav_style();
	}

	protected function register_style_layout() {
		$this->start_controls_section(
			'section_design_layout',
			array(
				'label' => esc_html__( 'Layout', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			)
		);
		$repeater_design = new \Elementor\Repeater();
		$repeater_design->add_control(
			'pos_item',
			[
				'label'   => esc_html__( 'Type', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'member_name',
			]
		);
		$this->add_control(
			'pos_content',
			[
				'label'        => esc_html__( 'Position Item of Content', 'hop-elementor-kit' ),
				'type'         => \Elementor\Controls_Manager::REPEATER,
				'fields'       => $repeater_design->get_controls(),
				'item_actions' => [
					'add'       => false,
					'duplicate' => false,
					'remove'    => false,
					'sort'      => true,
				],
				'default'      => [
					[
						'pos_item' => 'member_name',
					],
					[
						'pos_item' => 'member_position',
					],
					[
						'pos_item' => 'rating',
					],
					[
						'pos_item' => 'member_description',
					],
				],
				'title_field'  => '<span style="text-transform: capitalize;">{{{ pos_item.replace("_", " ") }}}</span>',
			]
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
					'{{WRAPPER}}' => '--hop-ekits-team-column-gap: {{SIZE}}{{UNIT}}',
				),
				'separator' => 'before',
				'condition' => array(
					'team_layout' => 'default',
				),
			)
		);

		$this->add_responsive_control(
			'row_gap',
			array(
				'label'              => esc_html__( 'Rows Gap', 'hop-elementor-kit' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => array(
					'size' => 35,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'selectors'          => array(
					'{{WRAPPER}}' => '--hop-ekits-team-row-gap: {{SIZE}}{{UNIT}}',
				),
				'condition'          => array(
					'team_layout' => 'default',
				),
			)
		);

		$this->add_responsive_control(
			'team_item_align',
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
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__article' => 'text-align: {{VALUE}};',
				),
			)
		);

		// Padding style

		$this->add_responsive_control(
			'team_item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__article' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// margin style

		$this->add_responsive_control(
			'team_item_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__article' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'team_item_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__article' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'team_item_tabs'
		);

		$this->start_controls_tab(
			'team_item_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'team_item_border',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-team__article',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'team_item_shadow_normal',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-team__article',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'team_item_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'team_item_border_hover',
				'label'    => esc_html__( 'Border', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-team__article:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'team_item_shadow_hover',
				'label'    => esc_html__( 'Box Shadow', 'hop-elementor-kit' ),
				'selector' => '{{WRAPPER}} .hop-ekit-team__article:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function register_style_image() {
		$this->start_controls_section(
			'section_style_image',
			array(
				'label' => esc_html__( 'Thumbnail Image', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'images_max_width',
			array(
				'label'      => esc_html__( 'Width Thumbnail', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__thumbnail' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'images_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs(
			'member_image_tabs'
		);

		$this->start_controls_tab(
			'member_image_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'bg_image_color',
			array(
				'label'     => esc_html__( 'Backgound Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}' => '--hop-ekits-bg-image-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'member_image_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'bg_image_hover_color',
			array(
				'label'     => esc_html__( 'Backgound Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' => '--hop-ekits-bg-image-hover-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'img_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}' => ' --hop-ekits-img-border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_spacing',
			array(
				'label'     => esc_html__( 'Spacing', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
				'default'   => array(
					'size' => 20,
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'selector' =>
					'{{WRAPPER}} .hop-ekit-team__thumbnail',

				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'exclude'  => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} .hop-ekit-team__thumbnail  img',
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_name() {
		$this->start_controls_section(
			'member_name_style',
			array(
				'label' => esc_html__( 'Member Name', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'member_name_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-team__member-name',
			)
		);

		$this->start_controls_tabs(
			'member_name_tabs'
		);

		$this->start_controls_tab(
			'member_name_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'member_name_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__member-name' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'member_name_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		$this->add_control(
			'member_name_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__member-name:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'member_name_margin',
			array(
				'label'      => esc_html__( 'Margin Bottom', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_position() {
		$this->start_controls_section(
			'member_position_style',
			array(
				'label' => esc_html__( 'Member Position', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'member_position_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-team__member-position',
			)
		);

		$this->add_control(
			'member_position_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__member-position' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'member_position_margin_bottom',
			array(
				'label'      => esc_html__( 'Margin Bottom', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),

				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__member-position' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'separator' => 'before',
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_description() {
		$this->start_controls_section(
			'member_description_style',
			array(
				'label' => esc_html__( 'Member Description', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'member_description_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-team__member-description',
			)
		);

		$this->add_responsive_control(
			'member_description_border',
			array(
				'label'     => esc_html__( 'Border Top Type', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'none'   => esc_html__( 'None', 'hop-elementor-kit' ),
					'solid'  => esc_html_x( 'Solid', 'Border Control', 'hop-elementor-kit' ),
					'double' => esc_html_x( 'Double', 'Border Control', 'hop-elementor-kit' ),
					'dotted' => esc_html_x( 'Dotted', 'Border Control', 'hop-elementor-kit' ),
					'dashed' => esc_html_x( 'Dashed', 'Border Control', 'hop-elementor-kit' ),
					'groove' => esc_html_x( 'Groove', 'Border Control', 'hop-elementor-kit' ),
				),
				'default'   => 'none',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__member-description' => 'border-top-style: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'member_description_border_dimensions',
			array(
				'label'       => esc_html_x( 'Width', 'Border Control', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => 0,
				'step'        => 1,
				'condition'   => array(
					'member_description_border!' => 'none',
				),
				'selectors'   => array(
					'{{WRAPPER}} .hop-ekit-team__member-description' => 'border-top-width: {{VALUE}}px;',
				),
			)
		);

		$this->add_control(
			'member_description_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'member_description_border!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__member-description' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'member_description_border_color_hover',
			array(
				'label'     => esc_html__( 'Border Color Hover', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'member_description_border!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__article:hover .hop-ekit-team__member-description' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'member_description_padding_top',
			array(
				'label'       => esc_html__( 'Padding Top', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => 0,
				'step'        => 1,
				'selectors'   => array(
					'{{WRAPPER}} .hop-ekit-team__member-description' => 'padding-top: {{VALUE}}px;',
				),
				'condition'   => array(
					'member_description_border!' => 'none',
				),
			)
		);

		$this->add_control(
			'description_lenght',
			array(
				'label'   => esc_html__( 'Description Lenght', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 25,
			)
		);

		$this->add_control(
			'description_more',
			array(
				'label'   => esc_html__( 'Description More', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '...',

			)
		);

		$this->add_control(
			'member_description_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__member-description' => 'color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function register_style_rating() {
		$this->start_controls_section(
			'member_rating_style',
			array(
				'label' => esc_html__( 'Member Rating', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'rating_align',
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
					'{{WRAPPER}} .hop-ekit-team__member-rating' => 'text-align: {{VALUE}};',
				),
			)
		);

		// Padding style

		$this->add_responsive_control(
			'rating_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__member-rating > i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'rating_position',
			array(
				'label'     => esc_html__( 'Position', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'static'   => esc_html__( 'Default', 'hop-elementor-kit' ),
					'absolute' => esc_html_x( 'Absolute', 'hop-elementor-kit' )
				),
				'default'   => 'absolute',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__member-rating' => 'position: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'rating_offset_position_v',
			array(
				'label'       => esc_html__( 'Vertical Position', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => '50',
				'options'     => array(
					'0'   => array(
						'title' => esc_html__( 'Top', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-top',
					),
					'50'  => array(
						'title' => esc_html__( 'Middle', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'100' => array(
						'title' => esc_html__( 'Bottom', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .hop-ekit-team__member-rating' => 'top:{{VALUE}}%;',
				),
				'condition'   => array(
					'rating_position' => 'absolute',
				),
			)
		);
		$this->add_responsive_control(
			'rating_vertical_offset',
			array(
				'label'       => esc_html__( 'Vertical align', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => - 500,
				'max'         => 500,
				'step'        => 1,
				'selectors'   => array(
					'{{WRAPPER}} .hop-ekit-team__member-rating' => '-webkit-transform: translateY({{VALUE}}px); -ms-transform: translateY({{SIZE}}px); transform: translateY({{SIZE}}px);',
				),
				'condition'   => array(
					'rating_position' => 'absolute',
				),
			)
		);

		$this->add_responsive_control(
			'rating_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FAD556',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__member-rating i' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'rating_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__member-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function register_style_social() {
		$this->start_controls_section(
			'social_style',
			array(
				'label' => esc_html__( 'Social', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		// Display design

		$this->add_control(
			'social_icon_display',
			array(
				'label'     => esc_html__( 'Display', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'block'        => array(
						'title' => esc_html__( 'Default', 'hop-elementor-kit' ),
						'icon'  => 'eicon-editor-list-ul',
					),
					'inline-block' => array(
						'title' => esc_html__( 'Inline', 'hop-elementor-kit' ),
						'icon'  => 'eicon-ellipsis-h',
					),
				),
				'default'   => 'inline-block',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__social' => 'display: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'social_icon_align',
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
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__list-social' => 'text-align: {{VALUE}};',
				),
			)
		);

		// start tab for content
		$this->start_controls_tabs(
			'social_icon_tabs'
		);

		// start normal tab
		$this->start_controls_tab(
			'social_icon_normal',
			array(
				'label' => esc_html__( 'Normal', 'hop-elementor-kit' ),
			)
		);

		// set social icon color
		$this->add_responsive_control(
			'social_icon_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__social > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		// end normal tab

		// start hover tab
		$this->start_controls_tab(
			'social_icon_hover',
			array(
				'label' => esc_html__( 'Hover', 'hop-elementor-kit' ),
			)
		);

		// set social icon color
		$this->add_responsive_control(
			'social_icon_hover_color',
			array(
				'label'     => esc_html__( 'Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3b5998',
				'selectors' => array(
					'{{WRAPPER}} .hop-ekit-team__social > a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		// end hover tab

		$this->end_controls_tabs();

		// Padding style

		$this->add_responsive_control(
			'social_icon_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__social > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		// margin style

		$this->add_responsive_control(
			'social_icon_margin',
			array(
				'label'      => esc_html__( 'Margin', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__social' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'social_offset_position_v',
			array(
				'label'       => esc_html__( 'Vertical Position', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => '50',
				'options'     => array(
					'0'   => array(
						'title' => esc_html__( 'Top', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-top',
					),
					'50'  => array(
						'title' => esc_html__( 'Middle', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'100' => array(
						'title' => esc_html__( 'Bottom', 'hop-elementor-kit' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .hop-ekit-team__list-social' => 'top:{{VALUE}}%;',
				),
			)
		);
		$this->add_responsive_control(
			'social_vertical_offset',
			array(
				'label'       => esc_html__( 'Vertical align', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::NUMBER,
				'label_block' => false,
				'min'         => - 500,
				'max'         => 500,
				'step'        => 1,
				'selectors'   => array(
					'{{WRAPPER}} .hop-ekit-team__list-social' => '-webkit-transform: translateY({{VALUE}}px); -ms-transform: translateY({{SIZE}}px); transform: translateY({{SIZE}}px);',
				),
			)
		);

		$this->add_responsive_control(
			'social_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 5,
					),
					'%'  => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-team__social > a i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$class       = 'hop-ekit-team';
		$class_inner = 'hop-ekit-team__inner';
		$class_item  = 'hop-ekit-team__article';

		if ( isset( $settings['team_layout'] ) && $settings['team_layout'] == 'slider' ) {
			$swiper_class = \Elementor\Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';
			$class        = 'hop-ekits-sliders ' . $swiper_class;
			$class_inner  = ' swiper-wrapper';
			$class_item   .= ' swiper-slide';
			$this->render_nav_pagination_slider( $settings );
		}
		?>

		<div class="<?php
		echo esc_attr( $class ); ?>">
			<div class="<?php
			echo esc_attr( $class_inner ); ?>">
				<?php
				$pos_items = $settings['pos_content'];
				// fix default position content
				if ( ! $pos_items ) {
					$pos_items = array(
						0 => [ 'pos_item' => 'member_name' ],
						1 => [ 'pos_item' => 'member_position' ],
						2 => [ 'pos_item' => 'rating' ],
						3 => [ 'pos_item' => 'member_description' ],
					);
				}

				if ( $settings['repeater'] ) {
					foreach ( $settings['repeater'] as $key => $item ) {
						?>
						<div <?php
						post_class( array( $class_item ) ); ?>>
							<?php
							$this->render_thumbnail( $settings, $item, $key );

							$this->render_text_header();

							foreach ( $pos_items as $pos_item ) {
								switch ( $pos_item["pos_item"] ) {
									case 'rating':
										$this->render_member_rating( $settings, $item );
										break;
									case 'member_position':
										$this->render_member_position( $settings, $item );
										break;
									case 'member_name' :
										$this->render_member_name( $settings, $item );
										break;
									case 'member_description':
										$this->render_member_description( $settings, $item );
										break;
								}
							}
							$this->render_text_footer();
							?>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>

		<?php
	}

	protected function render_thumbnail( $settings, $item, $key ) {
		$settings['thumbnail_id'] = $item['member_image'];
		$thumbnail_html           = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size',
			'thumbnail_id' );
		$op_tag                   = $cl_tag = '';
		if ( $settings['enable_link_member'] == 'yes' ) {
			$member_link     = $settings['link_member']['url'] ? $settings['link_member']['url'] : '#';
			$attributes_html = 'on' === $settings['link_member']['is_external'] ? 'target="_blank" rel="noopener noreferrer"' : '';
			$op_tag          = '<a class="hop-ekit-team__link" href="' . esc_url( $member_link ) . '" ' . $attributes_html . '>';
			$cl_tag          = '</a>';
		}

		if ( empty( $thumbnail_html ) ) {
			return;
		}
		?>
		<div class="hop-ekit-team__thumbnail">
			<?php
			echo wp_kses_post( $op_tag ); ?>
			<div class="hop-ekit-team__image">
				<?php
				echo wp_kses_post( $thumbnail_html );
				?>
			</div>
			<?php
			echo wp_kses_post( $cl_tag ); ?>
			<?php
			if ( apply_filters( 'hop-kits-team/thumbnail-social', true ) ) {
				echo $this->render_member_social( $item, $key );
			}
			?>
		</div>
		<?php
	}

	protected function render_text_header() {
		?>
		<div class="hop-ekit-team__content">
		<?php
	}

	protected function render_text_footer() {
		?>
		</div>
		<?php
	}

	protected function render_member_name( $settings, $item ) {
		if ( $settings['enable_link_member'] == 'yes' ) {
			$member_link     = $settings['link_member']['url'] ? $settings['link_member']['url'] : '#';
			$attributes_html = 'on' === $settings['link_member']['is_external'] ? 'target="_blank" rel="noopener noreferrer"' : '';
			$op_tag          = '<a class="hop-ekit-team__member-name" href="' . esc_url( $member_link ) . '" ' . $attributes_html . '>';
			$cl_tag          = '</a>';
		} else {
			$op_tag = '<div class="hop-ekit-team__member-name">';
			$cl_tag = '</div>';
		}

		if ( ! empty( $item['member_name'] ) ) {
			echo wp_kses_post( $op_tag );
			echo esc_html( $item['member_name'] );
			echo wp_kses_post( $cl_tag );
		}
	}

	protected function render_member_position( $settings, $item ) {
		if ( ! empty( $item['member_position'] ) ) {
			?>
			<div class="hop-ekit-team__member-position">
				<?php
				echo esc_html( $item['member_position'] ); ?>
			</div>
			<?php
		}
	}

	protected function render_member_description( $settings, $item ) {
		if ( ! empty( $item['member_description'] ) ) {
			?>
			<div class="hop-ekit-team__member-description">
				<?php
				echo wp_kses_post( wp_trim_words( $item['member_description'],
					absint( $settings['description_lenght'] ), $settings['description_more'] ) ); ?>
			</div>
			<?php
		}
	}

	protected function render_member_rating( $settings, $item ) {
		if ( ! empty( $item['show_rating'] == 'yes' ) ) {
			?>
			<div class="hop-ekit-team__member-rating">
				<?php
				$review_data = isset( $item['rating'] ) ? $item['rating'] : 0;

				for ( $m = 1; $m <= 5; $m ++ ) {
					$icon_start = 'eicon-star-o';
					if ( $review_data >= $m ) {
						$icon_start = 'eicon-star';
					}

					echo '<i class="' . esc_attr( $icon_start ) . '"></i>';
				}
				?>
			</div>
			<?php
		}
	}

	protected function render_member_social( $item, $key ) {
		$list_social = $item['icon_data'];

		$icons = array(
			'facebook'  => 'fab fa-facebook-f',
			'twitter'   => 'tk-x-twitter',
			'youtube'   => 'fab fa-youtube',
			'linked_in' => 'fab fa-linkedin-in',
		);

		$html = '<div class="hop-ekit-team__list-social">';
		foreach ( $list_social as $key_list => $value ) :
			if ( ! empty( $item[ $value . '_link' ]['url'] ) ) {
				$this->add_link_attributes( 'link-' . esc_attr( $key . '_' . $key_list ), $item[ $value . '_link' ] );
			}
			$html .= '<div class="hop-ekit-team__social">';
			$html .= '<a ' . $this->get_render_attribute_string( 'link-' . esc_attr( $key . '_' . $key_list ) ) . '>';
			$html .= '<i class="' . esc_attr( $icons[ $value ] ) . '" aria-hidden="true"></i>';
			$html .= '</a>
				</div>';
		endforeach;

		$html .= '</div>';

		return $html;
	}
}
