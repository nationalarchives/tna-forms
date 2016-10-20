<?php
/**
 * TNA form validation
 *
 */

function is_mandatory_text_field_valid( $data ) {
	if ( trim( $data ) === '' ) {
		return false;
	} else {
		$sanitize_data = sanitize_text_field( $data );
		return esc_attr( $sanitize_data );
	}
}
function is_text_field_valid( $data ) {
	if ( $data ) {
		$sanitize_data = sanitize_text_field( $data );
		return esc_attr( $sanitize_data );
	} else {
		return '';
	}
}
function is_mandatory_email_field_valid( $data ) {
	if ( trim( $data ) === '' || !is_email( $data ) ) {
		return false;
	} else {
		$sanitize_data = sanitize_email( $data );
		return esc_attr( $sanitize_data );
	}
}
function set_value( $name, $type = 'text', $select_value = '' ) {
	if (isset($_POST[$name])) {
		switch($type){
			case 'text': {
				return ' value="'.htmlspecialchars($_POST[$name]).'" ';
				break;
			}
			case 'textarea': {
				return htmlspecialchars($_POST[$name]);
				break;
			}
			case 'checkbox': {
				return ' checked="checked" ';
				break;
			}
			case 'radio': {
				if($_POST[$name] == $select_value){
					return ' checked="checked" ';
				}
				break;
			}
			case 'select': {
				if ($_POST[$name] == $select_value) {
					return ' selected="selected" ';
				}
				break;
			}
		}
	}
	return '';
}
