<?php
/**
 * TNA forms shortcode
 *
 */

function tna_forms_shortcode( $atts ) {

	$a = shortcode_atts( array(
		'name' => 'form',
		'session-title-1' => 'Training',
		'session-options-1' => 'No session times',
		'session-title-2' => 'Training',
		'session-options-2' => 'No session times'
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
		case 'IA training':
			return return_form_iacs_training(
				$a['session-title-1'],
				explode(', ', $a['session-options-1']),
				$a['session-title-2'],
				explode(', ', $a['session-options-2'])
			);
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
		'error' => '',
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