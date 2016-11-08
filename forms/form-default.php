<?php
/**
 * Form template
 *
 */

function return_form_default() {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	// HTML form string (I know, it's long!)
	$form = '<form action=""  id="default" method="POST">
	                <fieldset>
	                    <legend>Your enquiry</legend>
	                    <p class="mandatory">* mandatory field</p>
	                    <div class="form-row">
	                        <label for="forename">First name *</label>
	                        <input type="text" id="forename" name="forename" aria-required="true" required ' . set_value( 'forename' ) . '>
	                        ' . field_error_message( 'forename', 'Forename' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label for="surname">Last name *</label>
	                        <input type="text" id="surname" name="surname" aria-required="true" required ' . set_value( 'surname' ) . '>
	                        ' . field_error_message( 'surname', 'Surname' ) . '
	                    </div>
                        <div class="form-row">
                            <label for="email">Email address *</label>
                            <input type="email" id="email" name="email" aria-required="true" required ' . set_value( 'email' ) . '>
                            ' . field_error_message( 'email', 'Email' ) . '
                        </div>
                        <div class="form-row">
                            <label for="confirm_email">Please re-type your email address</label>
                            <input type="email" id="confirm_email" name="confirm-email" aria-required="true" required ' . set_value( 'confirm-email' ) . '>
                            ' . field_error_message( 'confirm-email', 'Confirm email', 'reconfirm', 'email' ) . '
                        </div>
	                    <div class="form-row">
	                        <label for="country">Country *</label>
	                        <input type="text" id="country" name="country" aria-required="true" required ' . set_value( 'country' ) . '>
	                        ' . field_error_message( 'country', 'Country' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label for="enquiry">Your enquiry *</label>
	                        <textarea id="enquiry" name="enquiry" aria-required="true" required>' . set_value( 'enquiry', 'textarea' ) . '</textarea>
	                        ' . field_error_message( 'enquiry', 'Enquiry' ) . '
	                    </div>
	                    <div class="form-row">
	                        <input type="submit" alt="Submit" name="submit-tna-form" id="submit-tna-form" value="Submit" class="button">
	                    </div>
	                </fieldset>
	            </form>';

	// If the form submission comes with errors give us back
	// the form populated with form data and error messages
	if ( $tna_error_message ) {
		return $tna_error_message . $form;
	}

	// If the form is successful give us the confirmation content
	elseif ( $tna_success_message ) {
		return $tna_success_message . print_page();
	}

	// If there no form submission, hence the user has
	// accessed the page for the first time, give us an empty form
	else {
		return $form;
	}
}

function process_form_default() {
	if ( ! is_admin() ) {

		// The processing happens at form submission.
		// If no form is submitted we stop here.
		if ( ! isset( $_POST['submit-tna-form'] ) ) {
			return;
		}

		// Global variables
		global $tna_success_message,
		       $tna_error_message,
		       $tna_error_messages;

		// Setting global variables
		$tna_success_message = '';
		$tna_error_message   = '';

		// Error messages for individual form fields stored into an array
		// IMPORTANT: $tna_error_messages array keys must match exactly the $form_fields array keys
		$tna_error_messages  = array(
			'Forename'              => 'Please enter your first name',
			'Surname'               => 'Please enter your last name',
			'Email'                 => 'Please enter a valid email address',
			'Confirm email'         => 'Please enter your email address again',
			'Country'               => 'Please enter a your country',
			'Enquiry'               => 'Please enter a your enquiry',
		);

		// Get the form elements and store them into an array
		// IMPORTANT: $form_fields array keys must match exactly the $tna_error_messages array keys
		$form_fields = array(
			'Forename'             => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'forename' ) ),
			'Surname'              => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'surname' ) ),
			'Email'                => is_mandatory_email_field_valid( filter_input( INPUT_POST, 'email' ) ),
			'Confirm email'        => does_fields_match( $_POST['confirm-email'], $_POST['email'] ),
			'Country'              => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'country' ) ),
			'Enquiry'              => is_textarea_field_valid( filter_input( INPUT_POST, 'postal-address' ) )
		);

		// If any value inside the array is false then there is an error
		if ( in_array( false, $form_fields ) ) {

			// Oops! Error!

			// Store error messages into the global variable
			$tna_error_message = display_error_message( $form_fields );

		} else {

			// Yay! Success!

			global $post;
			// Generate reference number based on user's surname and timestamp
			$ref_number = ref_number( $form_fields['Surname'], date_timestamp_get( date_create() ) );

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
			send_form_via_email( $form_fields['Email'], $ref_number, 'Your enquiry - Ref:', $email_to_user );

			// Store email content to TNA into a variable
			$email_to_tna = success_message_header( 'Reference number:', $ref_number );
			$email_to_tna .= display_compiled_form_data( $form_fields );

			// Send email to TNA
			send_form_via_email( get_option( 'admin_email' ), $ref_number, 'Enquiry - Ref:', $email_to_tna );

		}
	}
}
add_action('wp', 'process_form_default');
