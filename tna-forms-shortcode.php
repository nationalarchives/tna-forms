<?php
/**
 * TNA forms shortcode
 *
 */

function tna_forms_shortcode( $atts ) {

	$a = shortcode_atts( array(
		'name' => 'form'
	), $atts );

	switch ( $a['name'] ) {
		case 'British citizenship':
			return return_form_british_citizenship();
			break;
		case 'Records and research enquiry':
			return return_form_rre();
			break;
		case 'Your views':
			return return_form_your_views();
			break;
		default:
			return return_form_default();
			break;
	}
}

add_shortcode( 'tna-form', 'tna_forms_shortcode' );