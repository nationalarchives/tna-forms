<?php
/**
 * Form: Check for a certificate of British citizenship
 *
 */

function return_form_british_citizenship() {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	// HTML form string (I know, it's long!)
	$form = '<div class="arrow-steps clearfix">
	                <ul>
	                    <li class="current"><span>1</span> Certificate holder\'s details</li>
	                    <li><span>2</span> Certificate details</li>
	                    <li><span>3</span> Your details</li>
	                </ul>
	            </div>
	            <form action=""  id="naturalisation" method="POST">
	                <fieldset class="form-step-1">
	                    <legend>Certificate holder\'s details</legend>
	                    <p class="mandatory">* mandatory field</p>

	                    <p>Enter the details of the certificate holder at the time the certificate was issued.</p>
	                    <div class="form-row">
	                        <label for="certificate_forename">First name(s) *</label>
	                        <input type="text" id="certificate_forename" name="certificate-forename" aria-required="true" required ' . set_value( 'certificate-forename' ) . '>
	                        ' . field_error_message( 'certificate-forename', 'Certificate holder forename' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_surname">Last name *</label>
	                        <input type="text" id="certificate_surname" name="certificate-surname" aria-required="true" required ' . set_value( 'certificate-surname' ) . '>
	                        ' . field_error_message( 'certificate-surname', 'Certificate holder surname' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_surname_alt">Alternative last name</label>
	                        <input type="text" id="certificate_surname_alt" name="certificate-surname-alt" ' . set_value( 'certificate-surname-alt' ) . '>
	                        <p class="form-hint">For example: married or maiden names</p>
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_birth_country">Country of birth *</label>
	                        <input type="text" id="certificate_birth_country" name="certificate-birth-country" aria-required="true" required ' . set_value( 'certificate-birth-country' ) . '>
	                        ' . field_error_message( 'certificate-birth-country', 'Country of birth' ) . '
	                    </div>
	                    <p>Date of birth</p>
	                    <div class="form-row">
	                        <span class="dob-col day">
	                            <label for="certificate_day">Day</label>
	                            <input type="text" id="certificate_day" name="certificate-day" placeholder="DD" ' . set_value( 'certificate-day' ) . '>
	                        </span>
	                        <span class="dob-col month">
	                            <label for="certificate_month">Month</label>
	                            <input type="text" id="certificate_month" name="certificate-month" placeholder="MM" ' . set_value( 'certificate-month' ) . '>
	                        </span>
	                        <span class="dob-col year">
	                            <label for="certificate_year">Year</label>
	                            <input type="text" id="certificate_year" name="certificate-year" placeholder="YYYY" ' . set_value( 'certificate-year' ) . '>
	                        </span>
	                        <p class="form-hint">For example: 08 03 1955</p>
	                    </div>
	                    <p class="form-hint">If you are not sure of the exact date of birth, please enter an approximation</p>
	                    <div class="form-row dob-approx">
	                        <input id="certificate_dob_approx" type="checkbox" name="certificate-dob-approx" value="Yes" ' . set_value( 'certificate-dob-approx', 'checkbox' ) . '>
	                        <label for="certificate_dob_approx">Tick here if the date of birth is an approximation.</label>
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_postal_address">Address</label>
	                        <textarea id="certificate_postal_address" name="certificate-postal-address">' . set_value( 'certificate-postal-address', 'textarea' ) . '</textarea>
	                    </div>
	                    <div class="form-row form-nav">
	                        <a href="#" title="continue" class="button">Continue</a>
	                    </div>
	                    <p>For the protection of personal data, these details will not be retained by us.</p>
	                </fieldset>
	                <fieldset class="form-step-2">
	                    <div class="form-row form-nav">
	                        <a href="#" title="back" class="button-back">&#10094; Back</a>
	                    </div>
	                    <legend>Certificate details (optional)</legend>
	                    <p>If you know any details of the certificate, please provide them below. This will help us narrow down our search.</p>
	                    <div class="form-row">
	                        <label for="certificate_issued_country">Country of issue</label>
	                        <input type="text" id="certificate_issued_country" name="certificate-issued-country" ' . set_value( 'certificate-issued-country' ) . '>
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_number">Certificate number</label>
	                        <input type="text" id="certificate_number" name="certificate-number" ' . set_value( 'certificate-number' ) . '>
	                    </div>
	                    <div class="form-row registration-year">
	                        <label class="form-label" for="certificate_year_issued_from">Year of registration between</label>
	                        <select id="certificate_year_issued_from" name="certificate-year-issued-from">
	                            <option value="">Please select</option>
	                            <option value="1949" ' . set_value( 'certificate-year-issued-from', 'select', '1949' ) . '>1949</option>
	                            <option value="1950" ' . set_value( 'certificate-year-issued-from', 'select', '1950' ) . '>1950</option>
	                            <option value="1951" ' . set_value( 'certificate-year-issued-from', 'select', '1951' ) . '>1951</option>
	                            <option value="1952" ' . set_value( 'certificate-year-issued-from', 'select', '1952' ) . '>1952</option>
	                            <option value="1953" ' . set_value( 'certificate-year-issued-from', 'select', '1953' ) . '>1953</option>
	                        </select>
	                        <label class="form-label" for="certificate_year_issued_to">and</label>
	                        <select id="certificate_year_issued_to" name="certificate-year-issued-to">
	                            <option value="">Please select</option>
	                            <option value="1949" ' . set_value( 'certificate-year-issued-to', 'select', '1949' ) . '>1949</option>
	                            <option value="1950" ' . set_value( 'certificate-year-issued-to', 'select', '1950' ) . '>1950</option>
	                            <option value="1951" ' . set_value( 'certificate-year-issued-to', 'select', '1951' ) . '>1951</option>
	                            <option value="1952" ' . set_value( 'certificate-year-issued-to', 'select', '1952' ) . '>1952</option>
	                            <option value="1953" ' . set_value( 'certificate-year-issued-to', 'select', '1953' ) . '>1953</option>
	                        </select>
	                    </div>

	                    <div class="form-row form-nav ">
	                        <a href="#" title="continue" class="button">Continue</a>
	                    </div>
	                </fieldset>
	                <fieldset class="form-step-3">
	                    <div class="form-row form-nav">
	                        <a href="#" title="back" class="button-back">&#10094; Back</a>
	                    </div>
	                    <legend>Your details</legend>
	                    <p class="mandatory">* mandatory field</p>

	                    <p>Please provide your contact details so we can let you know the result of our check.</p>
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
	                    <p class="form-warning-error">How would you prefer to be contacted? *</p>
	                    ' . field_error_message( 'preferred-contact', 'Preferred contact', 'radio' ) . '
	                    <div class="form-col">
	                        <input id="contact_email" type="radio" name="preferred-contact" value="Email" ' . set_value( 'preferred-contact', 'radio', 'Email' ) . '>
	                        <label for="contact_email">Email</label>
	                    </div>
	                    <div class="form-col">
	                        <input id="contact_postal" type="radio" name="preferred-contact" value="Post" ' . set_value( 'preferred-contact', 'radio', 'Post' ) . '>
	                        <label for="contact_postal">Post</label>
	                    </div>
	                    <div class="email-wrapper">
	                        <div class="form-row">
	                            <label for="email">Email address</label>
	                            <input type="email" id="email" name="email" ' . set_value( 'email' ) . '>
	                            ' . field_error_message( 'email', 'Email' ) . '
	                        </div>
	                        <div class="form-row">
	                            <label for="confirm_email">Please re-type your email address</label>
	                            <input type="email" id="confirm_email" name="confirm-email" ' . set_value( 'confirm-email' ) . '>
	                            ' . field_error_message( 'confirm-email', 'Confirm email', 'reconfirm', 'email' ) . '
	                        </div>
	                    </div>
	                    <div class="form-row address-wrapper">
	                        <label for="postal_address">Postal address</label>
	                        <textarea id="postal_address" name="postal-address">' . set_value( 'postal-address', 'textarea' ) . '</textarea>
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

function process_form_british_citizenship() {
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
			'Certificate holder forename' => 'Please enter the certificate holder’s first name',
			'Certificate holder surname'  => 'Please enter the certificate holder’s last name',
			'Country of birth'            => 'Please enter the certificate holder’s country of birth',
			'Forename'                    => 'Please enter your first name',
			'Surname'                     => 'Please enter your last name',
			'Preferred contact'           => 'Please indicate your preferred method of contact',
			'Email'                       => 'Please enter a valid email address',
			'Confirm email'               => 'Please enter your email address again'
		);

		// Get the form elements and store them into an array
		// IMPORTANT: $form_fields array keys must match exactly the $tna_error_messages array keys
		$form_fields = array(
			'Certificate holder forename' => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'certificate-forename' ) ),
			'Certificate holder surname'  => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'certificate-surname' ) ),
			'Alternative surname'         => is_text_field_valid( filter_input( INPUT_POST, 'certificate-surname-alt' ) ),
			'Country of birth'            => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'certificate-birth-country' ) ),
			'DOB'                         => is_text_field_valid( filter_input( INPUT_POST, 'certificate-day' ) ) . '-' .
			                                 is_text_field_valid( filter_input( INPUT_POST, 'certificate-month' ) ) . '-' .
			                                 is_text_field_valid( filter_input( INPUT_POST, 'certificate-year' ) ),
			'Approx DOB'                  => ( isset( $_POST['certificate-dob-approx'] ) ) ? is_checkbox_radio_valid( filter_input( INPUT_POST, 'certificate-dob-approx' ) ) : 'No',
			'Certificate holder address'  => is_textarea_field_valid( filter_input( INPUT_POST, 'certificate-postal-address' ) ),
			'Country of issue'            => is_text_field_valid( filter_input( INPUT_POST, 'certificate-issued-country' ) ),
			'Certificate number'          => is_text_field_valid( filter_input( INPUT_POST, 'certificate-number' ) ),
			'Issued from'                 => is_text_field_valid( filter_input( INPUT_POST, 'certificate-year-issued-from' ) ),
			'Issued to'                   => is_text_field_valid( filter_input( INPUT_POST, 'certificate-year-issued-to' ) ),
			'Forename'                    => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'forename' ) ),
			'Surname'                     => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'surname' ) ),
			'Preferred contact'           => ( isset( $_POST['preferred-contact'] ) ) ? is_checkbox_radio_valid( filter_input( INPUT_POST, 'preferred-contact' ) ) : false,
			'Email'                       => is_email_field_valid( filter_input( INPUT_POST, 'email' ) ),
			'Confirm email'               => does_fields_match( $_POST['confirm-email'], $_POST['email'] ),
			'Postal address'              => is_textarea_field_valid( filter_input( INPUT_POST, 'postal-address' ) )
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
			$tna_success_message .= '<h3>Your application details</h3>';
			$tna_success_message .= display_compiled_form_data( $form_fields );

			// Store email content to user into a variable
			$email_to_user = success_message_header( 'Your reference number:', $ref_number );
			$email_to_user .= confirmation_content( $post->ID );
			$email_to_user .= '<h3>Your application details</h3>';
			$email_to_user .= display_compiled_form_data( $form_fields );

			// Send email to user
			send_form_via_email( $form_fields['Email'], $ref_number, 'Check for a certificate of British citizenship - Ref:',
				$email_to_user );

			// Store email content to TNA into a variable
			$email_to_tna = success_message_header( 'Reference number:', $ref_number );
			$email_to_tna .= display_compiled_form_data( $form_fields );

			// Send email to TNA
			send_form_via_email( get_option( 'admin_email' ), $ref_number, 'Certificate of British citizenship request - Ref:',
				$email_to_tna );

		}
	}
}
add_action('wp', 'process_form_british_citizenship');
