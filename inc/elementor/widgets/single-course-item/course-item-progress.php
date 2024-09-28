<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use LearnPress\TemplateHooks\UserItem\UserCourseTemplate;

class Hop_Ekit_Widget_Course_Item_Progress extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'hop-ekits-course-item-progress';
	}

	public function get_title() {
		return esc_html__( 'Course items progress', 'hop-elementor-kit' );
	}

	public function get_icon() {
		return 'hop-eicon eicon-progress-tracker';
	}

	public function get_categories() {
		return array( \Hop_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE_ITEM );
	}

	public function get_help_url() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'elementor' ),
			]
		);

		$social_repeater = new \Elementor\Repeater();

		$social_repeater->add_control(
			'item_progress',
			array(
				'label'   => esc_html__( 'Item', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'title',
				'options' => array(
					'results'      => esc_html__( '% Completed', 'hop-elementor-kit' ),
					'number'       => esc_html__( 'Number', 'hop-elementor-kit' ),
					'expire_time'  => esc_html__( 'Expire Time', 'hop-elementor-kit' ),
					'progress_bar' => esc_html__( 'Progress Bar', 'hop-elementor-kit' ),
				),
			)
		);

		$this->add_control(
			'item_progress_repeater',
			array(
				'label'       => esc_html__( 'Progress', 'hop-elementor-kit' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $social_repeater->get_controls(),
				'default'     => array(
					array(
						'item_progress' => 'number',
					),
					array(
						'item_progress' => 'progress_bar',
					),
				),
				'title_field' => '<span style="text-transform: capitalize;">{{{ item_progress.replace("_", " ") }}}</span>',
			)
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_progress_style',
			[
				'label' => esc_html__( 'Progress Bar', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bar_width',
			[
				'label'      => esc_html__( 'Width', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range'      => array(
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'  => [
					'{{WRAPPER}} .learn-press-progress' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'bar_height',
			[
				'label'     => esc_html__( 'Height', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .learn-press-progress' => 'height: {{SIZE}}{{UNIT}} !important; line-height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'bar_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .learn-press-progress'         => 'border-radius: {{SIZE}}{{UNIT}} !important; overflow: hidden;',
					'{{WRAPPER}} .learn-press-progress__active' => 'border-radius: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'progress_color',
			[
				'label'     => esc_html__( 'Progress Bar Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .learn-press-progress__active' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'progress_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'selectors' => [
					'{{WRAPPER}} .learn-press-progress::before' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'progress_circle',
			array(
				'label'   => esc_html__( 'Progress Circle', 'hop-elementor-kit' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			)
		);

		$this->add_control(
			'progress_circle_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .learn-press-progress__value' => 'color: {{VALUE}};',
				],
				'condition'   => array(
					'progress_circle' => 'yes',
				),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'progress_circle_typography',
				'selector' => '{{WRAPPER}} .learn-press-progress__value',
				'condition'   => array(
					'progress_circle' => 'yes',
				),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'Number', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-single-course-item__progress .number' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'bar_inner_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-course-item__progress .number',
				'exclude'  => [
					'line_height',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'bar_inner_shadow',
				'selector' => '{{WRAPPER}} .hop-ekit-single-course-item__progress .number',
			]
		);

		$this->add_responsive_control(
			'number_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-course-item__progress .number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_results_style',
			array(
				'label' => esc_html__( 'Results', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'results_color',
			[
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-single-course-item__progress .results' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'results_inner_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-course-item__progress .results',
			]
		);

		$this->add_responsive_control(
			'results_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-course-item__progress .results' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_expire_time_style',
			array(
				'label' => esc_html__( 'Expire Time', 'hop-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'expire_time_color',
			[
				'label'     => esc_html__( 'Text Color', 'hop-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hop-ekit-single-course-item__progress .expire-time' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'expire_time_inner_typography',
				'selector' => '{{WRAPPER}} .hop-ekit-single-course-item__progress .expire-time',
			]
		);

		$this->add_responsive_control(
			'expire_time_padding',
			array(
				'label'      => esc_html__( 'Padding', 'hop-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .hop-ekit-single-course-item__progress .expire-time' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'hop-ekit/modules/single-course-item/before-preview-query' );

		$settings = $this->get_settings_for_display();

		$user   = learn_press_get_current_user();
		$course = learn_press_get_course();

		if ( ! $user || ! $course ) {
			return;
		}

		$percentage      = 0;
		$total_items     = 0;
		$completed_items = 0;
		$course_data     = $user->get_course_data( $course->get_id() );

		if ( $course_data && ! $course->is_no_required_enroll() ) {
			$course_results  = $course_data->get_result();
			$completed_items = $course_results['completed_items'];
			$total_items     = $course_results['count_items'];
			$percentage      = $course_results['count_items'] ? absint( $course_results['completed_items'] / $course_results['count_items'] * 100 ) : 0;
			$expiration_time = $course_data->get_expiration_time();
		}
		?>

		<?php
		if ( $user->has_enrolled_or_finished( $course->get_id() ) ) : ?>
			<div class="hop-ekit-single-course-item__progress">
				<div class="items-progress hop-ekit-single-course-item__progress__inner" data-total-items="<?php
				echo esc_attr( $total_items ); ?>">
					<?php
					if ( $settings['item_progress_repeater'] ) : ?>
						<?php
						foreach ( $settings['item_progress_repeater'] as $item ) {
							switch ( $item['item_progress'] ) {
								case 'results':
									$this->render_results( $percentage );
									break;
								case 'number':
									$this->render_number( $completed_items, $course );
									break;
								case 'expire_time':
									if ( ! empty( $expiration_time ) ) {
										$this->render_expire_time( $course_data );
									}

									break;
								case 'progress_bar':
									if( $settings['progress_circle'] == 'yes' ) {
										$this->render_progress_bar_circle( $percentage );
									}else {
										$this->render_progress_bar( $percentage );
									}
									break;
							}
						}
						?>

					<?php
					endif; ?>
				</div>
			</div>
		<?php
		endif; ?>

		<?php
		do_action( 'hop-ekit/modules/single-course-item/after-preview-query' );
	}

	protected function render_results( $percentage ) {
		?>
		<span class="results">
			<?php
			echo esc_attr( $percentage ); ?>
			<span class="percentage-sign"><?php
				echo esc_html__( '% Complete', 'hop-elementor-kit' ); ?></span>
		</span>
		<?php
	}

	protected function render_number( $completed_items, $course ) {
		?>
		<span class="number">
			<?php
			echo
			wp_sprintf(
				__(
					'<span class="items-completed">%1$s</span> of %2$d items',
					'learnpress'
				),
				esc_html( $completed_items ),
				esc_html( $course->count_items() )
			);
			?>
		</span>
		<?php
	}

	protected function render_progress_bar( $percentage ) {
		?>
		<div class="learn-press-progress">
			<div class="learn-press-progress__active" data-value="<?php
			echo esc_attr( $percentage ); ?>%;">
			</div>
		</div>
		<?php
	}

	protected function render_progress_bar_circle( $percentage ) {
		?>
		<div class="learn-press-progress circle" style ="--progress: <?php echo esc_attr( $percentage )?>%;">
			<div class="learn-press-progress__value">
				<?php echo $percentage ."%"; ?>
			</div>
		</div>
		<?php
	}

	protected function render_expire_time( $user_course ) {
		$userCourseTemplate = UserCourseTemplate::instance();
		?>
		<span class="expire-time">
			<?php
			echo esc_html__( 'Expire time: ', 'hop-elementor-kit' ); ?>
			<span class="time"><?php
				echo wp_kses_post( $userCourseTemplate->html_expire_date_time( $user_course, false ) ); ?></span>
		</span>
		<?php
	}
}
