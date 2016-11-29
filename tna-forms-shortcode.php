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
		case 'General enquiries':
			return return_form_general();
			break;
		case 'Public sector':
			return return_form_public_sector();
			break;
		default:
			return return_form_default();
			break;
	}
}

add_shortcode( 'tna-form', 'tna_forms_shortcode' );

function tnafb_shortcode( $atts ) {

	$a = shortcode_atts( array(
		'type' => 'text',
		'name' => 'Full name',
		'error' => 'Please enter your full name',
		'hint'  => ''
	), $atts );

	$html = new Form_Builder;

	switch ( $a['type'] ) {
		case 'start':
			$id = strtolower( str_replace(' ', '_', $a['name']) );
			$value = strtolower( str_replace(' ', '-', $a['name']) );
			return $html->form_begins( $id, $value ) .
			       $html->fieldset_begins( $a['name'] );
			break;
		case 'end':
			$id = strtolower( str_replace(' ', '_', $a['name']) );
			$name = strtolower( str_replace(' ', '-', $a['name']) );
			return $html->submit_form( $name, $id ) .
			       $html->fieldset_ends() .
			       $html->form_ends();
			break;
		case 'text':
			$id = strtolower( str_replace(' ', '_', $a['name']) );
			$name = strtolower( str_replace(' ', '-', $a['name']) );
			return $html->form_text_input( $a['name'], $id, $name, $a['error'], $a['hint'] );
			break;
		case 'textarea':
			$id = strtolower( str_replace(' ', '_', $a['name']) );
			$name = strtolower( str_replace(' ', '-', $a['name']) );
			return $html->form_textarea_input( $a['name'], $id, $name, $a['error'], $a['hint'] );
			break;
	}
}

add_shortcode( 'form-builder', 'tnafb_shortcode' );