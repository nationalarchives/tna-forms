<?php

class Form_Processor {

	public function sanitize_value( $key ) {
		$value = filter_input( INPUT_POST, $key, FILTER_SANITIZE_STRING );
		$value = trim( $value );
		$newline = '--NEWLINE--';
		$value = str_replace( "\n", $newline, $value );
		$sanitize_value = str_replace( $newline, '<br />', $value );

		return $sanitize_value;
	}

	public function display_data( $data ) {
		if ( is_array( $data ) ) {
			$display_data = '<div class="form-data"><ul>';
			foreach ( $data as $field_name => $field_value ) {
				if ( strpos($field_name, 'skype-name') !== false || $field_name == 'confirm-email-required' || $field_name == 'confirm-email') {

					// do nothing

				} else {

					$field_name = ucfirst( str_replace('-required', '', $field_name) );
					$field_name = ucfirst( str_replace('-', ' ', $field_name) );

					$display_data .= '<li>' . $field_name . ': ' . $field_value . '</li>';
				}
			}
			$display_data .= '</ul></div>';

			return $display_data;
		}
	}

	public function get_data( $data ) {
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
							if ( trim( $_POST['email-required'] ) !== trim( $_POST['confirm-email-required'] ) ) {
								$form_data[$key] = false;
							} else {
								$form_data[$key] = true;
							}
						} else {
							$sanitize_value = $this->sanitize_value( $key );
							$form_data[$key] = $sanitize_value;
						}
					} else {
						if ( trim( $value ) === '' ) {
							$form_data[$key] = false;
						} else {
							$sanitize_value = $this->sanitize_value( $key );
							$form_data[$key] = $sanitize_value;
						}
					}
				} elseif ( trim( $value ) !== '' ) {
					$sanitize_value = $this->sanitize_value( $key );
					$form_data[$key] = $sanitize_value;
				} else {
					$form_data[$key] = '-';
				}
			}
		}

		return $form_data;
	}

	public function process_data( $form_name, $form_data, $tna_recipient = '' ) {

		// Global variables
		global $tna_success_message,
		       $tna_error_message;

		// Reset global variables
		$tna_success_message = '';
		$tna_error_message   = '';

		if ( isset($form_data['email-required']) ) {
			$user_email = $form_data['email-required'];
		} elseif ( isset($form_data['email']) ) {
			$user_email = $form_data['email'];
		} else {
			$user_email = '';
		}

		// If any value inside the array is false then there is an error
		if ( isset( $form_data['spam'] ) ) {

			// Oops! Spam!
			log_spam( 'yes', date_timestamp_get( date_create() ), $user_email );

		} elseif ( in_array( false, $form_data ) ) {

			// Oops! Error!
			// Store error message into the global variable
			$tna_error_message = display_error_message();

		} else {

			// Yay! Success!

			global $post;
			// Generate reference number based on user's surname and timestamp
			$ref_number = ref_number( 'TNA', date_timestamp_get( date_create() ) );
			$form_content = $this->display_data( $form_data );

			// Store confirmation content into the global variable
			$tna_success_message = $this->message( $form_name, $form_content, $ref_number, $post->ID, 'success' );

			// Store email content to user into a variable
			$user_email_content = $this->message( $form_name, $form_content, $ref_number, $post->ID, 'user' );

			// Send email to user
			send_form_via_email( $user_email, $form_name.' - Ref:', $ref_number, $user_email_content, '' );

			// Store email content to TNA into a variable
			$tna_email_content = $this->message( $form_name, $form_content, $ref_number, $post->ID );

			// Send email to TNA
			// Amend email address function with username to send email to desired destination.
			// eg, get_tna_email( 'contactcentre' )
			send_form_via_email( get_tna_email( $tna_recipient ), $form_name.' - Ref:', $ref_number, $tna_email_content, '' );

			// Subscribe to newsletter
			if (isset($form_data['newsletter'])) {
				subscribe_to_newsletter( $form_data['newsletter'], $form_data['full-name'], $user_email, $form_name, '' );
			}
		}
	}

	public function message( $form_name, $form_content, $ref_number, $id, $type = '' ) {
		if ( $type ) {
			$subject = 'Your reference number:';
		} else {
			$subject = 'Reference number:';
		}
		$content = success_message_header( $subject, $ref_number );
		if ( $type == 'user' ) {
			$content .= confirmation_email_content( $id );
		} elseif ( $type == 'success' ) {
			$content .= confirmation_content( $id );
		}
		if ( $type ) {
			$content .= '<h3>Summary of your enquiry</h3>';
		} else {
			$content .= '<h3>'.$form_name.'</h3>';
			$content .= '<h3>Summary of enquiry</h3>';
		}
		$content .= $form_content;

		return $content;
	}
}

function sanitize_value( $key ) {
	$value = filter_input( INPUT_POST, $key, FILTER_SANITIZE_STRING );
	$value = trim( $value );
	$newline = '--NEWLINE--';
	$value = str_replace( "\n", $newline, $value );
	$sanitize_value = str_replace( $newline, '<br />', $value );

	return $sanitize_value;
}

function display_form_data( $data ) {
	if ( is_array( $data ) ) {
		$display_data = '<div class="form-data"><ul>';
		foreach ( $data as $field_name => $field_value ) {
			if ( strpos($field_name, 'skype-name') !== false || $field_name == 'confirm-email-required' || $field_name == 'confirm-email') {

				// do nothing

			} else {

				$field_name = ucfirst( str_replace('-required', '', $field_name) );
				$field_name = ucfirst( str_replace('-', ' ', $field_name) );

				$display_data .= '<li>' . $field_name . ': ' . $field_value . '</li>';
			}
		}
		$display_data .= '</ul></div>';

		return $display_data;
	}
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
						if ( trim( $_POST['email-required'] ) !== trim( $_POST['confirm-email-required'] ) ) {
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

function process_form( $form_name, $form_data, $tna_recipient = '' ) {

	// Global variables
	global $tna_success_message,
	       $tna_error_message;

	// Setting global variables
	$tna_success_message = '';
	$tna_error_message   = '';

	if (isset($form_data['email-required'])) {
		$user_email = $form_data['email-required'];
	} elseif ( $form_data['email'] ) {
		$user_email = $form_data['email'];
	} else {
		$user_email = '';
	}

	// If any value inside the array is false then there is an error
	if ( isset( $form_data['spam'] ) ) {

		// Oops! Spam!
		log_spam( 'yes', date_timestamp_get( date_create() ), $user_email );

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
		$tna_success_message .= display_form_data( $form_data );

		// Store email content to user into a variable
		$email_to_user = success_message_header( 'Your reference number:', $ref_number );
		$email_to_user .= confirmation_email_content( $post->ID );
		$email_to_user .= '<h3>Summary of your enquiry</h3>';
		$email_to_user .= display_form_data( $form_data );

		// Send email to user
		send_form_via_email( $user_email, $form_name.' - Ref:', $ref_number, $email_to_user, '' );

		// Store email content to TNA into a variable
		$email_to_tna = success_message_header( 'Reference number:', $ref_number );
		$email_to_tna .= display_compiled_form_data( $form_data );

		// Send email to TNA
		// Amend email address function with username to send email to desired destination.
		// eg, get_tna_email( 'contactcentre' )
		send_form_via_email( get_tna_email( $tna_recipient ), $form_name.' - Ref:', $ref_number, $email_to_tna, '' );

		// Subscribe to newsletter
		if (isset($form_data['newsletter'])) {
			subscribe_to_newsletter( $form_data['newsletter'], $form_data['full-name'], $user_email, $form_name, '' );
		}
	}
}

