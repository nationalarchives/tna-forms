<?php
/**
 * TNA forms functions
 */

function set_value( $name, $type = 'text', $select_value = '' ) {
	if ( isset( $_POST[$name] ) ) {
		switch( $type ) {
			case 'text': {
				return ' value="' . htmlspecialchars( trim( $_POST[$name] ) ) . '" ';
				break;
			}
			case 'textarea': {
				if ( trim( $_POST[$name] ) !== '' ) {
					return htmlspecialchars( $_POST[$name] );
				}
				return '';
				break;
			}
			case 'checkbox': {
				return ' checked="checked" ';
				break;
			}
			case 'radio': {
				if( $_POST[$name] == $select_value ){
					return ' checked="checked" ';
				}
				break;
			}
			case 'select': {
				if ( $_POST[$name] == $select_value ) {
					return ' selected="selected" ';
				}
				break;
			}
		}
	}
	return '';
}

function field_error_message( $input_name, $error_field_name, $type = 'required', $reconfirm_name = '' ) {
	global $error_messages;
	$error_wrapper = '<span class="form-error form-hint">%s</span>';
	if ( isset( $_POST[$input_name] ) && isset( $_POST['submit'] ) ) {
		switch( $type ) {
			case 'required': {
				if ( trim( $_POST[$input_name] ) === '' ) {
					return sprintf( $error_wrapper, $error_messages[$error_field_name] );
				}
				break;
			}
			case 'reconfirm': {
				if ( trim( $_POST[$input_name] ) !== trim( $_POST[$reconfirm_name] ) ) {
					return sprintf( $error_wrapper, $error_messages[$error_field_name] );
				}
				break;
			}
		}
	} elseif ( !isset( $_POST[$input_name] ) && $type == 'radio' && isset( $_POST['submit'] ) ) {
		return sprintf( $error_wrapper, $error_messages[$error_field_name] );
	}
}

function ref_number( $name, $time_stamp ) {
	$prefix = 'TNA';
	if (strlen( $name ) > 3) {
		$suffix = strtoupper( substr( $name, 0, 3 ) );
	} else {
		$suffix = strtoupper( $name );
	}
	return $prefix . $time_stamp . $suffix;
}

function display_ref_number( $suffix ) {
	$ref_number_wrapper = '<div class="reference-number emphasis-block success-message"><p>Thank you!</p><p>Your reference number:</p><h2>%s</h2></div>';
	$ref_number = ref_number( $suffix, date_timestamp_get( date_create() ) );

	return sprintf( $ref_number_wrapper, $ref_number );
}

function display_compiled_form_data( $data ) {
	if ( is_array( $data ) ) {
		$display_data = '<div class="form-data"><ul>';
		foreach ( $data as $field_name => $field_value ) {
			if ( $field_value != '1' ) {
				$display_data .= '<li>' . $field_name . ': ' . $field_value . '</li>';
			}
		}
		$display_data .= '</ul></div>';

		return $display_data;
	}
}

function display_error_message( $data ) {
	global $error_messages;
	$error_message = '<div class="emphasis-block error-message"><h3>Error</h3><ul>';
	foreach ( $data as $field_name => $field_value ) {
		if ( $field_value == false ) {
			$error[$field_name] = $error_messages[$field_name];
			$error_message .= '<li>' . $error[$field_name] . '</li>';
		}
	}
	$error_message .= '</ul></div>';

	return $error_message;
}


