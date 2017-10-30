<?php

function sanitize_value( $key ) {
	$value = filter_input( INPUT_POST, $key, FILTER_SANITIZE_STRING );
	$value = trim( $value );
	$newline = '--NEWLINE--';
	$value = str_replace( "\n", $newline, $value );
	$sanitize_value = str_replace( $newline, '<br />', $value );

	return $sanitize_value;
}

function get_form_data( $data ) {
	$form_data = array();

	foreach( $data as $key => $value ) {
		if ( $key == 'tna-form' || $key == 'token' ||  $key == 'timestamp' || strpos($key, 'submit') !== false ) {

			// do nothing

		} elseif ( strpos($key, 'skype-name') !== false && trim( $value ) !== '' ) {

			$form_data['spam'] = true;

		} else {

			if ( strpos($key, 'required') !== false ) {
				if ( ( strpos($key, 'email') !== false ) ) {
					if ( trim( $value ) === '' || is_email( $value ) == false ) {
						$form_data[$key] = false;
					} elseif ( $key == 'confirm-email-required') {
						if ( trim( $_POST['email'] ) !== trim( $_POST['confirm_email'] ) ) {
							$form_data[$key] = false;
						} else {
							$form_data[$key] = true;
						}
					} else {
						$sanitize_value = sanitize_value( $key );
						$form_data[$key] = $sanitize_value;
					}
				} else {
					if ( trim( $value ) === '' ) {
						$form_data[$key] = false;
					} else {
						$sanitize_value = sanitize_value( $key );
						$form_data[$key] = $sanitize_value;
					}
				}
			} elseif ( trim( $value ) !== '' ) {
				$sanitize_value = sanitize_value( $key );
				$form_data[$key] = $sanitize_value;
			} else {
				$form_data[$key] = '-';
			}
		}
	}

	return $form_data;
}

function process_form( $form_name, $form_data, $form_tna_recipient = '' ) {

	var_dump($form_data);

	// Global variables
	global $tna_success_message,
	       $tna_error_message;

	// Setting global variables
	$tna_success_message = '';
	$tna_error_message   = '';

	// If any value inside the array is false then there is an error
	if ( isset( $form_data['spam'] ) ) {

		// Oops! Spam!
		log_spam( 'yes', date_timestamp_get( date_create() ), $form_data['email'] );

	} elseif ( in_array( false, $form_data ) ) {

		// Oops! Error!
		// Store error message into the global variable
		$tna_error_message = display_error_message();

	} else {

		// Yay! Success!

		global $post;
		// Generate reference number based on user's surname and timestamp
		$ref_number = ref_number( 'TNA', date_timestamp_get( date_create() ) );

		// Store confirmation content into the global variable
		$tna_success_message = success_message_header( 'Your reference number:', $ref_number );
		$tna_success_message .= confirmation_content( $post->ID );
		$tna_success_message .= '<h3>Summary of your enquiry</h3>';
		$tna_success_message .= display_compiled_form_data( $form_data );

		// Store email content to user into a variable
		$email_to_user = success_message_header( 'Your reference number:', $ref_number );
		$email_to_user .= confirmation_email_content( $post->ID );
		$email_to_user .= '<h3>Summary of your enquiry</h3>';
		$email_to_user .= display_compiled_form_data( $form_data );

		// Send email to user
		send_form_via_email( $form_data['email'], $form_name.' - Ref:', $ref_number, $email_to_user, '' );

		// Store email content to TNA into a variable
		$email_to_tna = success_message_header( 'Reference number:', $ref_number );
		$email_to_tna .= display_compiled_form_data( $form_data );

		// Send email to TNA
		// Amend email address function with username to send email to desired destination.
		// eg, get_tna_email( 'contactcentre' )
		send_form_via_email( get_tna_email( $form_tna_recipient ), $form_name.' - Ref:', $ref_number, $email_to_tna, '' );

		// Subscribe to newsletter
		if (isset($form_data['newsletter'])) {
			subscribe_to_newsletter( $form_data['newsletter'], $form_data['name'], $form_data['email'], $form_name, '' );
		}
	}
}

