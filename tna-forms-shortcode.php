<?php
/**
 * TNA forms shortcode
 *
 */

function tna_forms_shortcode( $atts, $content = '' ) {

	$a = shortcode_atts( array(
		'name' => 'form',
		'sessions' => '(Training, No session time 1, No session time 2)'
	), $atts );

	switch ( $a['name'] ) {
		case 'British citizenship':
			return return_form_british_citizenship( $content );
			break;
		case 'Records and research enquiry':
			return return_form_rre( $content );
			break;
		case 'Your views':
			return return_form_your_views( $content );
			break;
		case 'General enquiries':
			return return_form_general( $content );
			break;
		case 'Public sector':
			return return_form_public_sector( $content );
			break;
		case 'IA training':
			return return_form_iacs_training( explode(', ', $a['sessions']), $content );
			break;
		case 'Apply to film':
			return return_form_apply_to_film( $content );
			break;
		case 'PRONOM':
			return return_form_pronom( $content );
			break;
		case 'Document condition feedback':
			return return_form_dcf( $content );
			break;
        case 'Archive update':
            return return_form_archive_update ($content);
            break;
        case 'Request a paid search':
            return return_form_paid_search ($content);
            break;
        case 'Request an assessment of a document':
            return return_form_request_assessment_document ($content);
            break;
		case 'Apply for training':
			return return_form_apply_for_training( explode(', ', $a['sessions']), $content );
			break;
        case 'Letters of no evidence':
            return return_form_letters_of_no_evidence ($content);
            break;
		default:
			return return_form_default( $content );
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