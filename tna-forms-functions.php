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

function success_message_header_wrapper( $number ) {
	$wrapper = '<div class="reference-number emphasis-block success-message"><span>Your reference number:</span><h2>%s</h2></div>';

	return sprintf( $wrapper, $number );
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

function confirmation_content() {
	global $post;
	$child = get_pages(
		array( 'child_of' => $post->ID,
		       'number' => '1',
		       'sort_column' => 'post_date',
		       'sort_order' => 'desc'
		));

	$content = '';
	foreach( $child as $page ) {

		$content .= apply_filters( 'the_content', $page->post_content );

	}

	return $content;
}

function display_confirmation_page( $content, $success ) {
	$page = $content . $success;

	return $page;
}


