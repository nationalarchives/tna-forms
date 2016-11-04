<?php
/**
 * TNA form validation
 */

function is_mandatory_text_field_valid( $data ) {
	if ( trim( $data ) === '' ) {
		return false;
	} else {
		$sanitize_data = sanitize_text_field( $data );
		return esc_html( $sanitize_data );
	}
}
function is_text_field_valid( $data ) {
	if ( $data ) {
		$sanitize_data = sanitize_text_field( $data );
		return esc_html( $sanitize_data );
	} else {
		return '-';
	}
}
function is_textarea_field_valid( $data ) {
	if ( trim( $data ) !== '' ) {
		$sanitize_data = sanitize_text_field( $data );
		return esc_html( $sanitize_data );
	} else {
		return '-';
	}
}
function is_checkbox_radio_valid( $data ) {
	if ( $data ) {
		$sanitize_data = sanitize_text_field( $data );
		return esc_html( $sanitize_data );
	}
}
function is_mandatory_email_field_valid( $data ) {
	if ( trim( $data ) === '' || !is_email( $data ) ) {
		return false;
	} else {
		$sanitize_data = sanitize_email( $data );
		return esc_html( $sanitize_data );
	}
}
function is_email_field_valid( $data ) {
	if ( trim( $data ) === '' ) {
		return '-';
	} elseif ( !is_email( $data ) ) {
		return false;
	} else {
		$sanitize_data = sanitize_email( $data );
		return esc_html( $sanitize_data );
	}
}
function does_fields_match( $data, $reconfirm ) {
	if ( trim( $data ) !== trim( $reconfirm ) ) {
		return false;
	} else {
		return true;
	}
}
