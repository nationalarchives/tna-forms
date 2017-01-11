<?php
/**
 * Form: Information Assurance and Cyber Security training
 *
 */

function return_form_iacs_training( $sessions, $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	// HTML form string
	$html = new Form_Builder;
	$form =  $html->form_begins( 'iacs_training', 'Information Assurance and Cyber Security training' ) .
	         $html->fieldset_begins( 'Your details' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_input( 'Email address', 'email', 'email', 'Please enter a valid email address' ) .
	         $html->form_email_input( 'Please re-type your email address', 'confirm_email', 'confirm-email', 'Please enter your email address again', 'email' ) .
	         $html->form_tel_input( 'Telephone', 'telephone', 'telephone', 'Please enter your telephone number', '(include area code)' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Organisation details' ) .
	         $html->form_text_input( 'Job title', 'job_title', 'job-title', 'Please enter your job title' ) .
	         $html->form_text_input( 'Department/agency/organisation', 'organisation', 'organisation', 'Please enter a department/agency/organisation' ) .
	         $html->form_textarea_input( 'Address', 'address', 'address', 'Please enter an address' ) .
	         $html->form_select_input( 'Which of the following best describes your organisation?', 'organisation_type', 'organisation-type', array(
		         'Ministerial Department',
		         'Non-Ministerial Department',
		         'Executive Agency',
		         'Non-Departmental Public Body',
		         'Local Government',
		         'Police/Fire',
		         'NHS',
		         'Other - please specify below'
	         ), 'Please select an option' ) .
	         $html->form_text_input( 'Organisation, if \'Other\', please specify', 'other_organisation', 'other-organisation' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Role details' ) .
	         $html->form_select_input( 'Which of the following best describes your role?', 'your_role', 'your-role', array(
		         'SIRO',
		         'Audit Committee member',
		         'Executive Agency',
		         'Board member',
		         'IAO',
		         'Other IA role - please specify below'
	         ), 'Please select an option' ) .
	         $html->form_text_input( 'Role, if \'Other\', please specify', 'role_other', 'role-other' ) .
	         $html->form_text_input( 'How long have you held this role?', 'role_length', 'role-length' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Session details' ) .
	         $html->form_select_input_training( 'Session (1st choice)', 'session_first_choice', 'session-first-choice', $sessions, 'Please select an option' ) .
	         $html->form_select_input_training( 'Session (2nd choice)', 'session_second_choice', 'session-second-choice', $sessions, 'Please select an option' ) .
	         $html->form_select_input( 'Have you previously done any IA training?', 'previous_training', 'previous-training', array('Yes', 'No') ) .
	         $html->form_textarea_input( 'If yes, please provide details', 'previous_training_details', 'previous-training-details' ) .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-iacs', 'submit-tna-form' ) .
	         $html->fieldset_ends() .
	         $html->form_ends();

	// If the form submission comes with errors give us back
	// the form populated with form data and error messages
	if ( $tna_error_message ) {
		return $tna_error_message . $form;
	}

	// If the form is successful give us the confirmation content
	elseif ( $tna_success_message ) {
		return $tna_success_message . print_page();
	}

	// If no form submission, hence the user has
	// accessed the page for the first time, give us an empty form
	else {
		return $content . $form;
	}
}

function process_form_iacs_training() {
	// The processing happens at form submission.
	// If no form is submitted we stop here.
	if ( ! is_admin() && isset( $_POST['submit-iacs'] ) ) {

		// Checks for token
		// If the token exists then the form has been submitted so do nothing
		/* $token = filter_input( INPUT_POST, 'token' );
		if ( get_transient( 'token_' . $token ) ) {
			$_POST = array();
			return;
		}
		set_transient( 'token_' . $token, 'form-token', 360 ); */

		// Global variables
		global $tna_success_message,
		       $tna_error_message;

		// Setting global variables
		$tna_success_message = '';
		$tna_error_message   = '';

		// Get the form elements and store them into an array
		$form_fields = array(
			'Name'                      => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'full-name' ) ),
			'Email'                     => is_mandatory_email_field_valid( filter_input( INPUT_POST, 'email' ) ),
			'Confirm email'             => does_fields_match( $_POST['confirm-email'], $_POST['email'] ),
			'Telephone'                 => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'telephone' ) ),
			'Job title'                 => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'job-title' ) ),
			'Organisation'              => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'organisation' ) ),
			'Address'                   => is_mandatory_textarea_field_valid( filter_input( INPUT_POST, 'address' ) ),
			'Organisation description'  => is_mandatory_select_valid( filter_input( INPUT_POST, 'organisation-type' ) ),
			'Organisation other'        => is_text_field_valid( filter_input( INPUT_POST, 'other-organisation' ) ),
			'Role'                      => is_mandatory_select_valid( filter_input( INPUT_POST, 'your-role' ) ),
			'Role other'                => is_text_field_valid( filter_input( INPUT_POST, 'role-other' ) ),
			'Length in role'            => is_text_field_valid( filter_input( INPUT_POST, 'role-length' ) ),
			'Session 1st choice'        => is_mandatory_select_valid( filter_input( INPUT_POST, 'session-first-choice' ) ),
			'Session 2nd choice'        => is_mandatory_select_valid( filter_input( INPUT_POST, 'session-second-choice' ) ),
			'Previous training'         => is_select_valid( filter_input( INPUT_POST, 'previous-training' ) ),
			'Previous training details' => is_textarea_field_valid( filter_input( INPUT_POST, 'previous-training-details' ) ),
			'Spam'                      => is_this_spam( $_POST )
		);

		// If any value inside the array is false then there is an error
		if ( in_array( false, $form_fields ) ) {

			// Oops! Error!

			// Store error message into the global variable
			$tna_error_message = display_error_message();

			log_spam( $form_fields['Spam'], date_timestamp_get( date_create() ), $form_fields['Email'] );

		} else {

			// Yay! Success!

			global $post;
			// Generate reference number based on user's surname and timestamp
			$ref_number = ref_number( 'TNA', date_timestamp_get( date_create() ) );

			// Store confirmation content into the global variable
			$tna_success_message = success_message_header( 'Your reference number:', $ref_number );
			$tna_success_message .= confirmation_content( $post->ID );
			$tna_success_message .= '<p>If you provided your email address you will shortly receive an email confirming your application – please do not reply to this email</p>';
			$tna_success_message .= '<h3>Your details</h3>';
			$tna_success_message .= display_compiled_form_data( $form_fields );

			// Store email content to user into a variable
			$email_to_user = success_message_header( 'Your reference number:', $ref_number );
			$email_to_user .= confirmation_content( $post->ID );
			$email_to_user .= '<h3>Your details</h3>';
			$email_to_user .= display_compiled_form_data( $form_fields );

			// Send email to user
			send_form_via_email( $form_fields['Email'], 'Your training - Ref:', $ref_number, $email_to_user, $form_fields['Spam'] );

			// Store email content to TNA into a variable
			$email_to_tna = success_message_header( 'Reference number:', $ref_number );
			$email_to_tna .= display_compiled_form_data( $form_fields );

			// Send email to TNA
			// Amend email address function with username to send email to desired destination.
			// eg, get_tna_email( 'contactcentre' )
			send_form_via_email( get_tna_email(), 'IA training - Ref:', $ref_number, $email_to_tna, $form_fields['Spam'] );

			log_spam( $form_fields['Spam'], date_timestamp_get( date_create() ), $form_fields['Email'] );

		}
	}
}
add_action('wp', 'process_form_iacs_training');
