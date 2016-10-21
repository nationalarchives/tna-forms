<?php
/**
 * Form: Check for a certificate of British citizenship
 *
 */

function return_form_british_citizenship() {

	$form = '<form action="" id="naturalisation" method="POST">
                            <fieldset class="form-step-1">
                                <legend>Your details</legend>
                                <p>Enter your names in full.</p>
                                <div class="form-row">
                                    <label for="forename">First name *</label>
                                    <input value="" type="text" id="forename" name="forename" aria-required="true" required>
                                    <span class="error form-hint">This field is required</span>
                                </div>
                                <div class="form-row">
                                    <label for="surname">Last name *</label>
                                    <input value="" type="text" id="surname" name="surname" aria-required="true" required>
                                    <span class="error form-hint">This field is required TOO</span>
                                </div>
                                <p>How would you prefer to be contacted? *</p>
                                <div class="form-col">
                                    <input id="contact-email" type="radio" name="contact" value="email">
                                    <label for="contact-email">Email</label>
                                </div>
                                <div class="form-col">
                                    <input id="contact-postal" type="radio" name="contact" value="postal">
                                    <label for="contact-postal">Post</label>
                                </div>
                                <div class="email-wrapper">
                                    <div class="form-row">
                                        <label for="email">Email address</label>
                                        <input value="" type="email" id="email" name="email" aria-required="true" required>
                                        <span class="error form-hint">A valid email address is required</span>
                                    </div>
                                    <div class="form-row">
                                        <label for="confirm-email">Please re-type your email address</label>
                                        <input value="" type="email" id="confirm-email" name="email" aria-required="true" required>
                                        <span class="error form-hint">Email does not match</span>
                                    </div>
                                </div>
                                <div class="form-row address-wrapper">
                                    <label for="postal-address">Postal address</label>
                                    <textarea id="postal-address" name="postal-address"></textarea>
                                </div>
                                <div class="form-row form-nav ">
                                    <a href="#" title="continue" class="button">Continue</a>
                                </div>
                            </fieldset>
                            <fieldset class="form-step-2">
                                <div class="form-row form-nav">
                                    <a href="#" title="back" class="button-back">&#10094; Back</a>
                                </div>
                                <legend>Certificate holder\'s details</legend>
                                <p>Enter the details <strong>at registration</strong> of the person who was issued with the certificate.<br>Please note that for the protection of personal data, these details will not be retained by us.</p>
                                <div class="form-row">
                                    <label for="holder-forename">First name *</label>
                                    <input value="" type="text" id="holder-forename" name="holder-forename" aria-required="true" required>
                                </div>
                                <div class="form-row">
                                    <label for="holder-surname">Last name *</label>
                                    <input value="" type="text" id="holder-surname" name="holder-surname" aria-required="true" required>
                                </div>
                                <div class="form-row">
                                    <label for="holder-alt-surname">Alternative last name</label>
                                    <input value="" type="text" id="holder-alt-surname" name="holder-alt-surname">
                                    <p class="form-hint">For example: married or maiden names</p>
                                </div>
                                <div class="form-row">
                                    <label for="holder-country">Country of birth *</label>
                                    <input value="" type="text" id="holder-country" name="holder-country" aria-required="true" required>
                                </div>
                                <p>Date of birth</p>
                                <div class="form-row">
                                    <span class="dob-col day">
                                        <label for="holder-day">Day</label>
                                        <input value="" type="text" id="holder-day" name="holder-day" placeholder="DD">
                                    </span>
                                    <span class="dob-col month">
                                        <label for="holder-month">Month</label>
                                        <input value="" type="text" id="holder-month" name="holder-month" placeholder="MM">
                                    </span>
                                    <span class="dob-col year">
                                        <label for="holder-year">Year</label>
                                        <input value="" type="text" id="holder-year" name="holder-year" placeholder="YYYY">
                                    </span>
                                    <p class="form-hint">For example: 08 03 1955</p>
                                </div>
                                <p class="form-hint">If you\'re not sure of the exact date of birth enter any details you do have, even if it\'s just the year.</p>
                                <div class="form-row dob-approx">
                                    <input id="dob-approx" type="checkbox" name="dob-approx" value="dob-approx">
                                    <label for="dob-approx">Tick here if the date of birth is an approximation.</label>
                                </div>
                                <div class="form-row">
                                    <label for="holder-postal-address">Address</label>
                                    <textarea id="holder-postal-address" name="holder-postal-address"></textarea>
                                </div>
                                <div class="form-row form-nav">
                                    <a href="#" title="continue" class="button">Continue</a>
                                </div>
                            </fieldset>
                            <fieldset class="form-step-3">
                                <div class="form-row form-nav">
                                    <a href="#" title="back" class="button-back">&#10094; Back</a>
                                </div>
                                <legend>Certificate details</legend>
                                <p>If you know the details of the certificate, please enter them below. This will help us narrow down our search.</p>
                                <div class="form-row">
                                    <label for="country-of-issue">Country of issue</label>
                                    <input value="" type="text" id="country-of-issue" name="country-of-issue">
                                </div>
                                <div class="form-row">
                                    <label for="certificate-number">Certificate number</label>
                                    <input value="" type="text" id="certificate-number" name="certificate-number">
                                </div>
                                <div class="form-row registration-year">
                                    <label class="form-label" for="registration-year-start">Year of registration between</label>
                                    <select id="registration-year-start" name="registration-year-start">
                                        <option value="">Please select</option>
                                        <option value="1949">1949</option>
                                        <option value="1950">1950</option>
                                        <option value="1951">1951</option>
                                        <option value="1952">1952</option>
                                        <option value="1953">1953</option>
                                    </select>
                                    <label class="form-label" for="registration-year-end">and</label>
                                    <select id="registration-year-end" name="registration-year-end">
                                        <option value="">Please select</option>
                                        <option value="1949">1949</option>
                                        <option value="1950">1950</option>
                                        <option value="1951">1951</option>
                                        <option value="1952">1952</option>
                                        <option value="1953">1953</option>
                                    </select>
                                </div>
                                <div class="form-row">
                                    <input type="submit" alt="Submit" name="send-message" id="send-message" value="Submit" class="button">
                                </div>
                            </fieldset>
		</form>';
	return $form;
}

function process_form_british_citizenship() {

	if ( !isset($_POST['submit']) ) {
		return;
	}

	// Get the form elements and store them in variables
	$forename = is_mandatory_text_field_valid( $_POST['forename'] );
	$surname  = is_mandatory_text_field_valid( $_POST['surname'] );
	$email    = is_mandatory_email_field_valid( $_POST['email'] );

	if ( $forename == false || $surname == false || $email == false ) {

		// Error
		global $form_messages;
		$form_messages = '<div class="breather" style="background-color:rgba(252,228,92,.5);margin-bottom: 1em;border-left: 4px solid #fce45c;"><h3>Error</h3></div>';

	} else {

		// Success
		global $form_messages;
		$form_messages = '<div class="bg-success breather" style="margin-bottom: 1em;border-left: 4px solid green;"><h3>Thank you for your enquiry</h3><p>Your message has been sent to someone</p></div>';

		// Send email to these email addresses
		$to = array( get_option( 'admin_email' ), $email );

		// Email Subject
		$subject = $forename . ' ' . $surname . ' has completed the contact form';

		// Email message
		$message = '<p>Sender: ' . $forename . ' ' . $surname . '</p>';
		$message .= '<p>Email: ' . $email . '</p>';

		if ( $email ) {
			wp_mail( $to, $subject, $message );
		}

	}

}
add_action('init', 'process_form_british_citizenship');
