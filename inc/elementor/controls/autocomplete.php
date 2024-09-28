<?php

namespace Hop_EL_Kit\Elementor\Controls;

class Autocomplete extends \Elementor\Base_Data_Control {

	public function get_api_url() {
		return get_rest_url() . 'hop-ekit';
	}

	public function get_type() {
		return Controls_Manager::AUTOCOMPLETE;
	}

	public function enqueue() {
		wp_enqueue_script( 'hop-ekit-autocomplete-control',
			HOP_EKIT_PLUGIN_URL . 'inc/elementor/controls/assets/js/autocomplete.js' );
	}

	protected function get_default_settings() {
		return array(
			'options'     => array(),
			'multiple'    => false,
			'rest_action' => 'get-posts',
		);
	}

	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php
			echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<# var multiple = ( data.multiple ) ? 'multiple' : ''; #>
				<select
					id="<?php
					echo esc_attr( $control_uid ); ?>"
					class="hop-ekit-controls__autocomplete"
					{{ multiple }}
					data-setting="{{ data.name }}"
					data-ajax-url="<?php
					echo esc_attr( $this->get_api_url() . '/{{data.rest_action}}' ); ?>"
				>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}
}
