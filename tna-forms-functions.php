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
	global $tna_error_messages;
	$error_wrapper = '<span class="form-error form-hint">%s</span>';
	if ( isset( $_POST[$input_name] ) && isset( $_POST['submit-tna-form'] ) ) {
		switch( $type ) {
			case 'required': {
				if ( trim( $_POST[$input_name] ) === '' ) {
					return sprintf( $error_wrapper, $tna_error_messages[$error_field_name] );
				}
				break;
			}
			case 'reconfirm': {
				if ( trim( $_POST[$input_name] ) !== trim( $_POST[$reconfirm_name] ) ) {
					return sprintf( $error_wrapper, $tna_error_messages[$error_field_name] );
				}
				break;
			}
		}
	} elseif ( !isset( $_POST[$input_name] ) && $type == 'radio' && isset( $_POST['submit-tna-form'] ) ) {
		return sprintf( $error_wrapper, $tna_error_messages[$error_field_name] );
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

function success_message_header( $content = '', $number ) {
	$wrapper = '<div class="reference-number emphasis-block success-message"><span>%s</span><h2>%s</h2></div>';

	return sprintf( $wrapper, $content, $number );
}

function print_page() {
	$print = '<input class="print_button" type="button" onClick="window.print()" value="Print this page"/>';

	return $print;
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
	global $tna_error_messages;
	$error_message = '<div class="emphasis-block error-message"><h3>Error</h3><ul>';
	foreach ( $data as $field_name => $field_value ) {
		if ( $field_value == false ) {
			$error[$field_name] = $tna_error_messages[$field_name];
			$error_message .= '<li>' . $error[$field_name] . '</li>';
		}
	}
	$error_message .= '</ul></div>';

	return $error_message;
}

function confirmation_content( $id ) {

	$child = get_pages(
		array( 'child_of' => $id,
		       'number' => '1',
		       'sort_column' => 'post_date',
		       'sort_order' => 'desc'
		));

	$content = '';
	if ( $child ) {
		foreach( $child as $page ) {
			$content .= apply_filters( 'the_content', $page->post_content );
		}
	}

	return $content;
}

function send_form_via_email( $email, $ref_number, $subject, $content ) {
	if ( is_email( $email ) ) {

		// Email Subject
		$email_subject = $subject . ' ' . $ref_number;

		// Email message
		$email_message = $content;

		// Email header
		$email_headers = 'From: No reply <no-reply@nationalarchives.gov.uk>';

		wp_mail( $email, $email_subject, $email_message, $email_headers );
	}
}
