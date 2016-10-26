<?php
/**
 * Form: Check for a certificate of British citizenship
 *
 */

// Global variables
global $success_message,
       $error_message,
       $error_messages;
$success_message    = '';
$error_message      = '';
$error_messages     = array(
	'Certificate holder forename'   => 'Please enter the certificate holder’s first name',
	'Certificate holder surname'    => 'Please enter the certificate holder’s last name',
	'Country of birth'              => 'Please enter the certificate holder’s country of birth',
	'Forename'                      => 'Please enter your first name',
	'Surname'                       => 'Please enter your last name',
	'Preferred contact'             => 'Please indicate your preferred method of contact',
	'Confirm email'                 => 'Please enter your email address again'
);

function return_form_british_citizenship() {

	$form = '<form action=""  id="naturalisation" method="POST">
                            <fieldset class="form-step-1">
                                <legend>Certificate holder\'s details</legend>
                                <p>Enter the details of the certificate holder at the time the certificate was issued
                                    <br>
                                    Please note that for the protection of personal data, these details will not be retained by us.</p>
                                <div class="form-row">
                                    <label for="certificate_forename">First name(s) *</label>
                                    <input value="" type="text" id="certificate_forename" name="certificate-forename">
                                </div>
                                <div class="form-row">
                                    <label for="certificate_surname">Last name *</label>
                                    <input value="" type="text" id="certificate_surname" name="certificate-surname">
                                </div>
                                <div class="form-row">
                                    <label for="certificate_surname_alt">Alternative last name</label>
                                    <input value="" type="text" id="certificate_surname_alt" name="certificate-surname-alt">
                                    <p class="form-hint">For example: married or maiden names</p>
                                </div>
                                <div class="form-row">
                                    <label for="certificate_birth_country">Country of birth *</label>
                                    <input value="" type="text" id="certificate_birth_country" name="certificate-birth-country">
                                </div>
                                <p>Date of birth</p>
                                <div class="form-row">
                                    <span class="dob-col day">
                                        <label for="certificate_day">Day</label>
                                        <input value="" type="text" id="certificate_day" name="certificate-day" placeholder="DD">
                                    </span>
                                    <span class="dob-col month">
                                        <label for="certificate_month">Month</label>
                                        <input value="" type="text" id="certificate_month" name="certificate-month" placeholder="MM">
                                    </span>
                                    <span class="dob-col year">
                                        <label for="certificate_year">Year</label>
                                        <input value="" type="text" id="certificate_year" name="certificate-year" placeholder="YYYY">
                                    </span>
                                    <p class="form-hint">For example: 08 03 1955</p>
                                </div>
                                <p class="form-hint">If you are not sure of the exact date of birth, please enter an approximation</p>
                                <div class="form-row dob-approx">
                                    <input id="certificate_dob_approx" type="checkbox" name="certificate-dob-approx" value="dob-approx">
                                    <label for="certificate_dob_approx">Tick here if the date of birth is an approximation.</label>
                                </div>
                                <div class="form-row">
                                    <label for="certificate_postal_address">Address</label>
                                    <textarea id="certificate_postal_address" name="certificate-postal-address"></textarea>
                                </div>
                                <div class="form-row form-nav">
                                    <a href="#" title="continue" class="button">Continue</a>
                                </div>
                            </fieldset>

                            <fieldset class="form-step-2">
                                <div class="form-row form-nav">
                                    <a href="#" title="back" class="button-back">&#10094; Back</a>
                                </div>
                                <legend>Certificate details (optional)</legend>
                                <p>If you know any details of the certificate, please provide them below. This will help us narrow down our search.</p>
                                <div class="form-row">
                                    <label for="certificate_issued_country">Country of issue</label>
                                    <input value="" type="text" id="certificate_issued_country" name="certificate-issued-country">
                                </div>
                                <div class="form-row">
                                    <label for="certificate_number">Certificate number</label>
                                    <input value="" type="text" id="certificate_number" name="certificate-number">
                                </div>
                                <div class="form-row registration-year">
                                    <label class="form-label" for="certificate_year_issued_from">Year of registration between</label>
                                    <select id="certificate_year_issued_from" name="certificate-year-issued-from">
                                        <option value="">Please select</option>
                                        <option value="1949">1949</option>
                                        <option value="1950">1950</option>
                                        <option value="1951">1951</option>
                                        <option value="1952">1952</option>
                                        <option value="1953">1953</option>
                                    </select>
                                    <label class="form-label" for="certificate_year_issued_to">and</label>
                                    <select id="certificate_year_issued_to" name="certificate-year-issued-to">
                                        <option value="">Please select</option>
                                        <option value="1949">1949</option>
                                        <option value="1950">1950</option>
                                        <option value="1951">1951</option>
                                        <option value="1952">1952</option>
                                        <option value="1953">1953</option>
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
                                <p>Please provide your contact details so we can let you know the result of our check</p>
                                <div class="form-row">
                                    <label for="forename">First name *</label>
                                    <input value="" type="text" id="forename" name="forename">
                                </div>
                                <div class="form-row">
                                    <label for="surname">Last name *</label>
                                    <input value="" type="text" id="surname" name="surname">
                                </div>
                                <p class="form-warning-error">How would you prefer to be contacted? *</p>
                                <div class="form-col">
                                    <input id="contact_email" type="radio" name="preferred-contact" value="contact_email">
                                    <label for="contact_email">Email</label>
                                </div>
                                <div class="form-col">
                                    <input id="contact_postal" type="radio" name="preferred-contact" value="contact_postal">
                                    <label for="contact_postal">Post</label>
                                </div>
                                <div class="email-wrapper">
                                    <div class="form-row">
                                        <label for="email">Email address</label>
                                        <input value="" type="email" id="email" name="email">
                                    </div>
                                    <div class="form-row">
                                        <label for="confirm_email">Please re-type your email address</label>
                                        <input value="" type="email" id="confirm_email" name="confirm-email">
                                    </div>
                                </div>
                                <div class="form-row address-wrapper">
                                    <label for="postal_address">Postal address</label>
                                    <textarea id="postal_address" name="postal-address"></textarea>
                                </div>

                                <div class="form-row">
                                    <input type="submit" alt="Submit" name="submit" id="send-message" value="Submit" class="button">
                                </div>
                            </fieldset>
                        </form>';

	global $success_message,
	       $error_message,
	       $error_messages;

	if ( $error_message ) {
		return $error_message . $form;
	} elseif ( $success_message ) {
		return $success_message;
	} else {
		return $form;
	}
}

function process_form_british_citizenship() {

	global $success_message,
	       $error_message,
	       $error_messages;

	if ( !isset($_POST['submit']) ) {
		return;
	}

	// Get the form elements and store them into an array
	$form_fields = array(
		'Certificate holder forename'   => is_mandatory_text_field_valid( $_POST['certificate-forename'] ),
		'Certificate holder surname'    => is_mandatory_text_field_valid( $_POST['certificate-surname'] ),
		'Alternative surname'           => is_text_field_valid( $_POST['certificate-surname-alt'] ),
		'Country of birth'              => is_mandatory_text_field_valid( $_POST['certificate-birth-country'] ),
		'DOB day'                       => is_text_field_valid( $_POST['certificate-day'] ),
		'DOB month'                     => is_text_field_valid( $_POST['certificate-month'] ),
		'DOB year'                      => is_text_field_valid( $_POST['certificate-year'] ),
		'Approx DOB'                    => is_text_field_valid( $_POST['certificate-dob-approx'] ),
		'Certificate holder address'    => is_text_field_valid( $_POST['certificate-postal-address'] ),
		'Country of issue'              => is_text_field_valid( $_POST['certificate-issued-country'] ),
		'Certificate number'            => is_text_field_valid( $_POST['certificate-number'] ),
		'Issued from'                   => is_text_field_valid( $_POST['certificate-year-issued-from'] ),
		'Issued to'                     => is_text_field_valid( $_POST['certificate-year-issued-to'] ),
		'Forename'                      => is_mandatory_text_field_valid( $_POST['forename'] ),
		'Surname'                       => is_mandatory_text_field_valid( $_POST['surname'] ),
		'Preferred contact'             => is_mandatory_text_field_valid( $_POST['preferred-contact'] ),
		'Email'                         => is_text_field_valid( $_POST['email'] ),
		'Confirm email'                 => does_fields_match( $_POST['confirm-email'], $_POST['email'] ),
		'Postal address'                => is_text_field_valid( $_POST['postal-address'] )
	);

	$success_message = display_compiled_form_data( $form_fields );

	$error_message = display_error_message( $form_fields );

}
add_action('init', 'process_form_british_citizenship');
