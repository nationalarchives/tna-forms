<?php
/**
 * TNA forms functions
 */

function set_value( $name, $type = 'text', $select_value = '' ) {
	if ( isset( $_POST[$name] ) ) {
		switch( $type ) {
			case 'text': {
				return ' value="' . htmlspecialchars( $_POST[$name] ) . '" ';
				break;
			}
			case 'textarea': {
				return htmlspecialchars( $_POST[$name] );
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

function field_error_message( $name, $type = 'required', $reconfirm_name = '' ) {
	global $error_messages, $error_wrapper;
	if ( isset( $_POST[$name] ) ) {
		switch( $type ){
			case 'required': {
				if ( trim( $_POST[$name] ) === '' ) {
					return sprintf( $error_wrapper, $error_messages[$name] );
				}
				break;
			}
			case 'reconfirm': {
				if ( trim( $_POST[$name] ) !== trim( $_POST[$reconfirm_name] ) ) {
					return sprintf( $error_wrapper, $error_messages[$name] );
				}
				break;
			}
		}
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

if ( !function_exists('wp_mail_set_text_body') ) :
	function wp_mail_set_text_body( $phpmailer ) {
		if ( empty( $phpmailer->AltBody ) ) {
			$phpmailer->AltBody = strip_tags( $phpmailer->Body );
		}
	}
endif;
add_action( 'phpmailer_init', 'wp_mail_set_text_body' );