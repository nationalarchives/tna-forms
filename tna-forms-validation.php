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
function is_mandatory_textarea_field_valid( $data ) {
	if ( trim( $data ) === '' ) {
		return false;
	} else {
		$data = trim( $data );
		$newline = '--NEWLINE--';
		$data = str_replace( "\n", $newline, $data );
		$sanitize_data = sanitize_text_field( $data );
		$sanitize_data = str_replace( $newline, '<br />', esc_html( $sanitize_data ) );
		return $sanitize_data;
	}
}
function is_textarea_field_valid( $data ) {
	if ( trim( $data ) !== '' ) {
		$data = trim( $data );
		$newline = '--NEWLINE--';
		$data = str_replace( "\n", $newline, $data );
		$sanitize_data = sanitize_text_field( $data );
		$sanitize_data = str_replace( $newline, '<br />', esc_html( $sanitize_data ) );
		return $sanitize_data;
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
function is_radio_valid( $data ) {
	if ( $data ) {
		$sanitize_data = sanitize_text_field( $data );
		return esc_html( $sanitize_data );
	}
}
function is_checkbox_valid( $data ) {
	if ( $data ) {
		$sanitize_data = sanitize_text_field( $data );
		return esc_html( $sanitize_data );
	} else {
		return 'No';
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
function is_mandatory_select_valid( $data ) {
	if ( trim( $data ) === '' ) {
		return false;
	} else {
		$sanitize_data = sanitize_text_field( $data );
		return esc_html( $sanitize_data );
	}
}
function is_select_valid( $data ) {
	if ( $data ) {
		$sanitize_data = sanitize_text_field( $data );
		return esc_html( $sanitize_data );
	} else {
		return '-';
	}
}
function does_fields_match( $data, $reconfirm ) {
	if ( trim( $data ) !== trim( $reconfirm ) ) {
		return false;
	} else {
		return true;
	}
}

function is_this_spam( $data ) {
	$spam = false;
	foreach( $data as $key => $value ) {
		if ( strpos($key, 'skype-name') !== false && $value !== false ) {
			$spam = true;
		}
		if ( $key == 'timestamp' && ( time() - $value < 5 ) ) {
			$spam = true;
		}
		if ( $key == 'timestamp' && ( time() - $value < 21600 ) ) {
			$spam = true;
		}
	}
	if ( $spam ) {
		return 'yes';
	} else {
		return 'no';
	}
}
