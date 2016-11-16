<?php
/**
 * Form: Records and research enquiry (RRE)
 *
 */

function return_form_rre() {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	// HTML form string (I know, it's long!)
	$form = '<form action=""  id="records-research-enquiry" method="POST">
					<input type="hidden" name="tna-form" value="rre">
					<input type="hidden" name="token" value="' . form_token() . '">
	                <fieldset>
	                    <legend>Your enquiry</legend>
	                    <div class="form-row">
	                        <label for="forename">First name <span class="optional">(optional)</span></label>
	                        <input type="text" id="forename" name="forename" ' . set_value( 'forename' ) . '>
	                    </div>
	                    <div class="form-row">
	                        <label for="surname">Last name <span class="optional">(optional)</span></label>
	                        <input type="text" id="surname" name="surname" ' . set_value( 'surname' ) . '>
	                    </div>
                        <div class="form-row">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" aria-required="true" required ' . set_value( 'email' ) . '>
                            ' . field_error_message( 'email', 'Email' ) . '
                        </div>
                        <div class="form-row">
                            <label for="confirm_email">Please re-type your email address</label>
                            <input type="email" id="confirm_email" name="confirm-email" aria-required="true" required ' . set_value( 'confirm-email' ) . '>
                            ' . field_error_message( 'confirm-email', 'Confirm email', 'reconfirm', 'email' ) . '
                        </div>
	                    <div class="form-row">
	                        <label for="country">Country</label>
	                        <input type="text" id="country" name="country" aria-required="true" required ' . set_value( 'country' ) . '>
	                        ' . field_error_message( 'country', 'Country' ) . '
	                    </div>
	                    <div class="form-row textarea">
	                        <p>Please provide specific details of the information you are looking for and avoid requests like &#34;anything you can tell me&#34; on a person or subject.</p>
	                        <label for="enquiry">Your enquiry</label>
	                        <textarea id="enquiry" name="enquiry" aria-required="true" required>' . set_value( 'enquiry', 'textarea' ) . '</textarea>
	                        ' . field_error_message( 'enquiry', 'Enquiry' ) . '
	                    </div>
	                    <div class="form-row">
	                        <p>Please provide the dates or years that you are interested in. <span class="optional">(optional)</span></p>
	                        <label for="from-date">From date</label>
	                        <p class="form-hint">(Date or year)</p>
	                        <input type="text" id="from_date" name="from-date" ' . set_value( 'from-date' ) . '>
	                    </div>
	                    <div class="form-row">
	                        <label for="to-date">To date</label>
	                        <p class="form-hint">(Date or year)</p>
	                        <input type="text" id="to_date" name="to-date" ' . set_value( 'to-date' ) . '>
	                    </div>
	                    <div class="form-row">
	                        <input type="submit" alt="Submit" name="submit-rre" id="submit-tna-form" value="Submit" class="button">
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

function process_form_rre() {
	// The processing happens at form submission.
	// If no form is submitted we stop here.
	if ( ! is_admin() && isset( $_POST['submit-rre'] ) ) {

		// Checks for token
		// If the token exists then the form has been submitted so do nothing
		$token = filter_input( INPUT_POST, 'token' );
		if ( get_transient( 'token_' . $token ) ) {
			$_POST = array();
			return;
		}
		set_transient( 'token_' . $token, 'form-token', 180 );

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
			'Email'                 => 'Please enter a valid email address',
			'Confirm email'         => 'Please enter your email address again',
			'Country'               => 'Please enter your country',
			'Enquiry'               => 'Please enter your enquiry'
		);

		// Get the form elements and store them into an array
		// IMPORTANT: $form_fields array keys must match exactly the $tna_error_messages array keys
		$form_fields = array(
			'Forename'             => is_text_field_valid( filter_input( INPUT_POST, 'forename' ) ),
			'Surname'              => is_text_field_valid( filter_input( INPUT_POST, 'surname' ) ),
			'Email'                => is_mandatory_email_field_valid( filter_input( INPUT_POST, 'email' ) ),
			'Confirm email'        => does_fields_match( $_POST['confirm-email'], $_POST['email'] ),
			'Country'              => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'country' ) ),
			'Enquiry'              => is_mandatory_textarea_field_valid( filter_input( INPUT_POST, 'enquiry' ) ),
			'From date'            => is_text_field_valid( filter_input( INPUT_POST, 'from-date' ) ),
			'To date'              => is_text_field_valid( filter_input( INPUT_POST, 'to-date' ) )
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
			$tna_success_message .= '<h3>Your enquiry</h3>';
			$tna_success_message .= display_compiled_form_data( $form_fields );

			// Store email content to user into a variable
			$email_to_user = success_message_header( 'Your reference number:', $ref_number );
			$email_to_user .= confirmation_content( $post->ID );
			$email_to_user .= '<h3>Your enquiry</h3>';
			$email_to_user .= display_compiled_form_data( $form_fields );

			// Send email to user
			send_form_via_email( $form_fields['Email'], $ref_number, 'Your records and research enquiry - Ref:', $email_to_user );

			// Store email content to TNA into a variable
			$email_to_tna = success_message_header( 'Reference number:', $ref_number );
			$email_to_tna .= display_compiled_form_data( $form_fields );

			// Send email to TNA
			send_form_via_email( get_tna_email( 'contactcentre' ), $ref_number, 'Records and research enquiry - Ref:', $email_to_tna );

		}
	}
}
add_action('wp', 'process_form_rre');
