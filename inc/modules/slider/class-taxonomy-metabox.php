<?php

namespace Hop_EL_Kit\Modules\Slider;

use Hop_EL_Kit\SingletonTrait;
use Hop_EL_Kit\Modules\Slider\Post_Type;

class Taxonomy_Metabox {
	use SingletonTrait;

	public function __construct() {
		add_action( Post_Type::TAXONOMY . '_add_form_fields', array( $this, 'add_taxonomy_metabox' ), 10, 2 );
		add_action( Post_Type::TAXONOMY . '_edit_form_fields', array( $this, 'edit_taxonomy_metabox' ), 8, 2 );
		add_action( 'edited_' . Post_Type::TAXONOMY, array( $this, 'save_taxonomy_metabox' ), 10, 2 );
		add_action( 'create_' . Post_Type::TAXONOMY, array( $this, 'save_taxonomy_metabox' ), 10, 2 );
	}

	/**
	 * Add taxonomy metabox
	 *
	 * @param $taxonomy
	 */
	public function add_taxonomy_metabox( $taxonomy ) {
		wp_nonce_field( 'hop_ekits_slider_taxonomy_nonce', 'hop_ekits_slider_taxonomy_nonce', false, true );
		?>
		<h2><?php
			esc_html_e( 'Slider Settings', 'hop-elementor-kit' ); ?></h2>
		<div class="form-field term-group">
			<label for="hop-ekit-slider-type"><?php
				esc_html_e( 'Slider Type', 'hop-elementor-kit' ); ?></label>
			<select name="hop_ekit_slider_type" id="hop-ekit-slider-type">
				<option value=""><?php
					esc_html_e( 'Select Slider Type', 'hop-elementor-kit' ); ?></option>
				<option value="carousel"><?php
					esc_html_e( 'Carousel', 'hop-elementor-kit' ); ?></option>
				<option value="slider"><?php
					esc_html_e( 'Slider', 'hop-elementor-kit' ); ?></option>
			</select>
		</div>
		<?php
	}

	/**
	 * Edit taxonomy metabox
	 *
	 * @param $term
	 * @param $taxonomy
	 */
	public function edit_taxonomy_metabox( $term, $taxonomy ) {
		$hop_ekit_slider_type = get_term_meta( $term->term_id, 'hop_ekit_slider_type', true );
		?>

		<?php
		wp_nonce_field( 'hop_ekits_slider_taxonomy_nonce', 'hop_ekits_slider_taxonomy_nonce', false, true ); ?>

		<tr class="form-field term-group-wrap">
			<th scope="row">
				<label for="hop-ekit-slider-type"><?php
					esc_html_e( 'Slider Type', 'hop-elementor-kit' ); ?></label>
			</th>
			<td>
				<select name="hop_ekit_slider_type" id="hop-ekit-slider-type">
					<option value=""><?php
						esc_html_e( 'Select Slider Type', 'hop-elementor-kit' ); ?></option>
					<option value="carousel" <?php
					selected( $hop_ekit_slider_type, 'carousel' ); ?>><?php
						esc_html_e( 'Carousel', 'hop-elementor-kit' ); ?></option>
					<option value="slider" <?php
					selected( $hop_ekit_slider_type, 'slider' ); ?>><?php
						esc_html_e( 'Slider', 'hop-elementor-kit' ); ?></option>
				</select>
			</td>
		</tr>
		<?php
	}

	public function save_taxonomy_metabox( $term_id ) {
		if ( ! isset( $_POST['hop_ekits_slider_taxonomy_nonce'] ) || ! wp_verify_nonce( $_POST['hop_ekits_slider_taxonomy_nonce'],
				'hop_ekits_slider_taxonomy_nonce' ) ) {
			return;
		}

		$slider_type = isset( $_POST['hop_ekit_slider_type'] ) ? sanitize_text_field( wp_unslash( $_POST['hop_ekit_slider_type'] ) ) : '';

		update_term_meta( $term_id, 'hop_ekit_slider_type', $slider_type );
	}
}

Taxonomy_Metabox::instance();
