<?php
/**
 * Form: Check for a certificate of British citizenship
 *
 */
function return_form_british_citizenship( $content ) {
	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;
	// HTML form string (I know, it's long!)
	$form = '<div class="arrow-steps clearfix">
	                <ul>
	                    <li class="current"><span>1</span> Certificate holder\'s details</li>
	                    <li><span>2</span> Certificate details</li>
	                    <li><span>3</span> Contact details</li>
	                </ul>
	            </div>
	            <form action=""  id="naturalisation" class="form-abandonment" method="POST">
	            	<input type="hidden" name="tna-form" value="naturalisation">
	            	<input type="hidden" name="token" value="' . form_token() . '">
	            	<input type="hidden" name="timestamp" value="' . time() . '">
	                <fieldset class="form-step-1">
	                    <legend>Certificate holder\'s details</legend>
	                    <div class="form-row">
	                        <p>Enter the details of the certificate holder at the time the certificate was issued.</p>
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_first_name">Certificate holder first name</label>
	                        <input type="text" id="certificate_first_name" name="certificate-first-name" ' . set_value( 'certificate-first-name' ) . '>
	                        ' . field_error_message( 'certificate-first-name', 'Certificate holder first name' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_last_name">Certificate holder last name</label>
	                        <input type="text" id="certificate_last_name" name="certificate-last-name" ' . set_value( 'certificate-last-name' ) . '>
	                        ' . field_error_message( 'certificate-last-name', 'Certificate holder last name' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_first_name_alt">Certificate holder alternative first name(s) <span class="optional">(optional)</span></label>
	                        <input type="text" id="certificate_first_name_alt" name="certificate-first-name-alt" ' . set_value( 'certificate-first-name-alt' ) . '>
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_last_name_alt">Certificate holder alternative last name(s) <span class="optional">(optional)</span></label>
	                        <p id="last-name-alt" class="form-hint">For example, married or maiden names</p>
	                        <input type="text" aria-describedby="last-name-alt" id="certificate_last_name_alt" name="certificate-last-name-alt" ' . set_value( 'certificate-last-name-alt' ) . '>
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_birth_country">Country of birth <span class="optional">(optional)</span></label>
	                        <input type="text" id="certificate_birth_country" name="certificate-birth-country" ' . set_value( 'certificate-birth-country' ) . '>
	                    </div>
	                    <div class="form-row">
	                    <p id="dob">Date of birth <span class="optional">(optional)</span></p>
	                    <p class="form-hint">For example, 8 3 1955</p>
	                        <span class="dob-col day">
	                            <label id="day" for="certificate_day">Day</label>
	                            <input type="number" aria-labelledby="dob day" id="certificate_day" name="certificate-day" ' . set_value( 'certificate-day' ) . '>
	                        </span>
	                        <span class="dob-col month">
	                            <label id="month" for="certificate_month">Month</label>
	                            <input type="number" aria-labelledby="dob month" id="certificate_month" name="certificate-month" ' . set_value( 'certificate-month' ) . '>
	                        </span>
	                        <span class="dob-col year">
	                            <label id="year" for="certificate_year">Year</label>
	                            <input type="number" aria-labelledby="dob year" id="certificate_year" name="certificate-year" ' . set_value( 'certificate-year' ) . '>
	                        </span>
	                    </div>
	                    <div class="form-row checkbox dob-approx">
	                        <input id="certificate_dob_approx" type="checkbox" name="certificate-dob-approx" value="Yes" ' . set_value( 'certificate-dob-approx', 'checkbox' ) . '>
	                        <label for="certificate_dob_approx">Tick here if the date of birth is an approximation.</label>
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_postal_address">Address at time of registration <span class="optional">(optional)</span></label>
	                        <textarea id="certificate_postal_address" name="certificate-postal-address">' . set_value( 'certificate-postal-address', 'textarea' ) . '</textarea>
	                    </div>
	                    <div class="form-row form-nav">
	                        <a href="#" title="continue" class="button">Continue</a>
	                    </div>
	                </fieldset>
	                <fieldset class="form-step-2">
	                    <legend>Certificate details (optional)</legend>
	                    <div class="form-row form-nav">
	                        <a href="#" title="back" class="button-back">&#10094; Back</a>
	                    </div>
	                    <div class="form-row">
	                        <p>If you know any details of the certificate, please provide them below. This will help us narrow down our search.</p>
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_issued_country">Country of issue <span class="optional">(optional)</span></label>
	                        <input type="text" id="certificate_issued_country" name="certificate-issued-country" ' . set_value( 'certificate-issued-country' ) . '>
	                    </div>
	                    <div class="form-row">
	                        <label for="certificate_number">Certificate number <span class="optional">(optional)</span></label>
	                        <input type="text" id="certificate_number" name="certificate-number" ' . set_value( 'certificate-number' ) . '>
	                    </div>
	                    <div class="form-row registration-year">
	                    <p><label id="year-of-registration" class="form-label" for="certificate_year_issued_from">Year of registration <span class="optional">(optional)</span></label></p>
	                        <label id="from" class="form-label" for="certificate_year_issued_from">from</label>
	                        <select id="certificate_year_issued_from" name="certificate-year-issued-from">
	                            <option value="" aria-label="Certificate year of registration from (optional). Please select a year.">Please select</option>
	                            <option value="1949" ' . set_value( 'certificate-year-issued-from', 'select', '1949' ) . '>1949</option>
	                            <option value="1950" ' . set_value( 'certificate-year-issued-from', 'select', '1950' ) . '>1950</option>
	                            <option value="1951" ' . set_value( 'certificate-year-issued-from', 'select', '1951' ) . '>1951</option>
	                            <option value="1952" ' . set_value( 'certificate-year-issued-from', 'select', '1952' ) . '>1952</option>
	                            <option value="1953" ' . set_value( 'certificate-year-issued-from', 'select', '1953' ) . '>1953</option>
	                            <option value="1954" ' . set_value( 'certificate-year-issued-from', 'select', '1954' ) . '>1954</option>
	                            <option value="1955" ' . set_value( 'certificate-year-issued-from', 'select', '1955' ) . '>1955</option>
	                            <option value="1956" ' . set_value( 'certificate-year-issued-from', 'select', '1956' ) . '>1956</option>
	                            <option value="1957" ' . set_value( 'certificate-year-issued-from', 'select', '1957' ) . '>1957</option>
	                            <option value="1958" ' . set_value( 'certificate-year-issued-from', 'select', '1958' ) . '>1958</option>
	                            <option value="1959" ' . set_value( 'certificate-year-issued-from', 'select', '1959' ) . '>1959</option>
	                            <option value="1960" ' . set_value( 'certificate-year-issued-from', 'select', '1960' ) . '>1960</option>
	                            <option value="1961" ' . set_value( 'certificate-year-issued-from', 'select', '1961' ) . '>1961</option>
	                            <option value="1962" ' . set_value( 'certificate-year-issued-from', 'select', '1962' ) . '>1962</option>
	                            <option value="1963" ' . set_value( 'certificate-year-issued-from', 'select', '1963' ) . '>1963</option>
	                            <option value="1964" ' . set_value( 'certificate-year-issued-from', 'select', '1964' ) . '>1964</option>
	                            <option value="1965" ' . set_value( 'certificate-year-issued-from', 'select', '1965' ) . '>1965</option>
	                            <option value="1966" ' . set_value( 'certificate-year-issued-from', 'select', '1966' ) . '>1966</option>
	                            <option value="1967" ' . set_value( 'certificate-year-issued-from', 'select', '1967' ) . '>1967</option>
	                            <option value="1968" ' . set_value( 'certificate-year-issued-from', 'select', '1968' ) . '>1968</option>
	                            <option value="1969" ' . set_value( 'certificate-year-issued-from', 'select', '1969' ) . '>1969</option>
	                            <option value="1970" ' . set_value( 'certificate-year-issued-from', 'select', '1970' ) . '>1970</option>
	                            <option value="1971" ' . set_value( 'certificate-year-issued-from', 'select', '1971' ) . '>1971</option>
	                            <option value="1972" ' . set_value( 'certificate-year-issued-from', 'select', '1972' ) . '>1972</option>
	                            <option value="1973" ' . set_value( 'certificate-year-issued-from', 'select', '1973' ) . '>1973</option>
	                            <option value="1974" ' . set_value( 'certificate-year-issued-from', 'select', '1974' ) . '>1974</option>
	                            <option value="1975" ' . set_value( 'certificate-year-issued-from', 'select', '1975' ) . '>1975</option>
	                            <option value="1976" ' . set_value( 'certificate-year-issued-from', 'select', '1976' ) . '>1976</option>
	                            <option value="1977" ' . set_value( 'certificate-year-issued-from', 'select', '1977' ) . '>1977</option>
	                            <option value="1978" ' . set_value( 'certificate-year-issued-from', 'select', '1978' ) . '>1978</option>
	                            <option value="1979" ' . set_value( 'certificate-year-issued-from', 'select', '1979' ) . '>1979</option>
	                            <option value="1980" ' . set_value( 'certificate-year-issued-from', 'select', '1980' ) . '>1980</option>
	                            <option value="1981" ' . set_value( 'certificate-year-issued-from', 'select', '1981' ) . '>1981</option>
	                            <option value="1982" ' . set_value( 'certificate-year-issued-from', 'select', '1982' ) . '>1982</option>
	                            <option value="1983" ' . set_value( 'certificate-year-issued-from', 'select', '1983' ) . '>1983</option>
	                            <option value="1984" ' . set_value( 'certificate-year-issued-from', 'select', '1984' ) . '>1984</option>
	                            <option value="1985" ' . set_value( 'certificate-year-issued-from', 'select', '1985' ) . '>1985</option>
								<option value="1986" ' . set_value( 'certificate-year-issued-from', 'select', '1986' ) . '>1986</option>
	                        </select>
	                        <label id="to" class="form-label" for="certificate_year_issued_to">to</label>
	                        <select id="certificate_year_issued_to" name="certificate-year-issued-to">
	                            <option value="" aria-label="Certificate year of registration to (optional). Please select a year.">Please select</option>
	                            <option value="1949" ' . set_value( 'certificate-year-issued-to', 'select', '1949' ) . '>1949</option>
	                            <option value="1950" ' . set_value( 'certificate-year-issued-to', 'select', '1950' ) . '>1950</option>
	                            <option value="1951" ' . set_value( 'certificate-year-issued-to', 'select', '1951' ) . '>1951</option>
	                            <option value="1952" ' . set_value( 'certificate-year-issued-to', 'select', '1952' ) . '>1952</option>
	                            <option value="1953" ' . set_value( 'certificate-year-issued-to', 'select', '1953' ) . '>1953</option>
	                            <option value="1954" ' . set_value( 'certificate-year-issued-to', 'select', '1954' ) . '>1954</option>
	                            <option value="1955" ' . set_value( 'certificate-year-issued-to', 'select', '1955' ) . '>1955</option>
	                            <option value="1956" ' . set_value( 'certificate-year-issued-to', 'select', '1956' ) . '>1956</option>
	                            <option value="1957" ' . set_value( 'certificate-year-issued-to', 'select', '1957' ) . '>1957</option>
	                            <option value="1958" ' . set_value( 'certificate-year-issued-to', 'select', '1958' ) . '>1958</option>
	                            <option value="1959" ' . set_value( 'certificate-year-issued-to', 'select', '1959' ) . '>1959</option>
	                            <option value="1960" ' . set_value( 'certificate-year-issued-to', 'select', '1960' ) . '>1960</option>
	                            <option value="1961" ' . set_value( 'certificate-year-issued-to', 'select', '1961' ) . '>1961</option>
	                            <option value="1962" ' . set_value( 'certificate-year-issued-to', 'select', '1962' ) . '>1962</option>
	                            <option value="1963" ' . set_value( 'certificate-year-issued-to', 'select', '1963' ) . '>1963</option>
	                            <option value="1964" ' . set_value( 'certificate-year-issued-to', 'select', '1964' ) . '>1964</option>
	                            <option value="1965" ' . set_value( 'certificate-year-issued-to', 'select', '1965' ) . '>1965</option>
	                            <option value="1966" ' . set_value( 'certificate-year-issued-to', 'select', '1966' ) . '>1966</option>
	                            <option value="1967" ' . set_value( 'certificate-year-issued-to', 'select', '1967' ) . '>1967</option>
	                            <option value="1968" ' . set_value( 'certificate-year-issued-to', 'select', '1968' ) . '>1968</option>
	                            <option value="1969" ' . set_value( 'certificate-year-issued-to', 'select', '1969' ) . '>1969</option>
	                            <option value="1970" ' . set_value( 'certificate-year-issued-to', 'select', '1970' ) . '>1970</option>
	                            <option value="1971" ' . set_value( 'certificate-year-issued-to', 'select', '1971' ) . '>1971</option>
	                            <option value="1972" ' . set_value( 'certificate-year-issued-to', 'select', '1972' ) . '>1972</option>
	                            <option value="1973" ' . set_value( 'certificate-year-issued-to', 'select', '1973' ) . '>1973</option>
	                            <option value="1974" ' . set_value( 'certificate-year-issued-to', 'select', '1974' ) . '>1974</option>
	                            <option value="1975" ' . set_value( 'certificate-year-issued-to', 'select', '1975' ) . '>1975</option>
	                            <option value="1976" ' . set_value( 'certificate-year-issued-to', 'select', '1976' ) . '>1976</option>
	                            <option value="1977" ' . set_value( 'certificate-year-issued-to', 'select', '1977' ) . '>1977</option>
	                            <option value="1978" ' . set_value( 'certificate-year-issued-to', 'select', '1978' ) . '>1978</option>
	                            <option value="1979" ' . set_value( 'certificate-year-issued-to', 'select', '1979' ) . '>1979</option>
	                            <option value="1980" ' . set_value( 'certificate-year-issued-to', 'select', '1980' ) . '>1980</option>
	                            <option value="1981" ' . set_value( 'certificate-year-issued-to', 'select', '1981' ) . '>1981</option>
	                            <option value="1982" ' . set_value( 'certificate-year-issued-to', 'select', '1982' ) . '>1982</option>
	                            <option value="1983" ' . set_value( 'certificate-year-issued-to', 'select', '1983' ) . '>1983</option>
	                            <option value="1984" ' . set_value( 'certificate-year-issued-to', 'select', '1984' ) . '>1984</option>
	                            <option value="1985" ' . set_value( 'certificate-year-issued-to', 'select', '1985' ) . '>1985</option>
								<option value="1986" ' . set_value( 'certificate-year-issued-to', 'select', '1986' ) . '>1986</option>
	                        </select>
	                    </div>
	                    <div class="form-row form-nav ">
	                        <a href="#" title="continue" class="button">Continue</a>
	                    </div>
	                </fieldset>
	                <fieldset class="form-step-3">
	                    <legend>Contact details</legend>
	                    <div class="form-row form-nav">
	                        <a href="#" title="back" class="button-back">&#10094; Back</a>
	                    </div>
	                    <div class="form-row">
	                        <p id="provide_details">Please provide your details so we can let you know whether we\'ve found the certificate.</p>
	                    </div>
	                    <div class="form-row">
	                        <label id="title_label" for="title">Title <span class="optional">(optional)</span></label>
	                        <input type="text" aria-labelledby="provide_details title_label" id="title" name="title" ' . set_value( 'title' ) . '>
	                        ' . field_error_message( 'title', 'Title' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label id="first_name_label" for="first_name">First name</label>
	                        <input type="text" aria-labelledby="provide_details first_name_label" id="first_name" name="first-name" aria-required="true" required ' . set_value( 'first-name' ) . '>
	                        ' . field_error_message( 'first-name', 'First name' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label id="last_name_label" for="last_name">Last name</label>
	                        <input type="text" aria-labelledby="provide_details last_name_label" id="last_name" name="last-name" aria-required="true" required ' . set_value( 'last-name' ) . '>
	                        ' . field_error_message( 'last-name', 'Last name' ) . '
	                    </div>
	                    <div class="form-row">
	                        <p id="prefer-contact">Do you have an email address ?</p>
		                    ' . field_error_message( 'preferred-contact', 'Preferred contact', 'radio' ) . '
		                    <div class="form-col pref_contact radio">
		                        <input id="contact_email" aria-labelledby="we-can-let prefer-contact email-label" type="radio" name="preferred-contact" value="Email" ' . set_value( 'preferred-contact', 'radio', 'Email' ) . '>
		                        <label id="email-label" for="contact_email">Yes</label>
		                    </div>
		                    <div class="form-col pref_contact radio">
		                        <input id="contact_postal" aria-labelledby="prefer-contact post-label" type="radio" name="preferred-contact" value="Post" ' . set_value( 'preferred-contact', 'radio', 'Post' ) . '>
		                        <label id="post-label" for="contact_postal">No</label>
		                    </div>
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




				
	                    <div class="address-wrapper">

	                    <div class="form-row">
	                        <label id="address_1_label" for="address_1">Address line 1</label>
	                        <input type="text" aria-labelledby="provide_details address_1_label" id="address_1" name="address-street-1" ' . set_value( 'address_1' ) . '>
	                        ' . field_error_message( 'addresss-street-1', 'Address line 1' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label id="address_2_label" for="address_2">Address line 2<span class="optional">(optional)</span></label>
	                        <input type="text" aria-labelledby="provide_details address_2_label" id="address_2" name="address-street-2" ' . set_value( 'address_2' ) . '>
	                        ' . field_error_message( 'addresss-street-2', 'Address line 2' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label id="address_town_city_label" for="address_town_city">Town or city</label>
	                        <input type="text" aria-labelledby="provide_details address_town_city_label" id="address_town_city" name="address-town-city" ' . set_value( 'address_town_city' ) . '>
	                        ' . field_error_message( 'addresss-town-city', 'Town or city' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label id="address_county_label" for="address_county">County<span class="optional">(optional)</span></label>
	                        <input type="text" aria-labelledby="provide_details address_county_label" id="address_county" name="address-county" ' . set_value( 'address_county' ) . '>
	                        ' . field_error_message( 'addresss-county', 'County' ) . '
	                    </div>

	                    <div class="form-row">
	                        <label id="address_postcode_label" for="address_postcode">Postcode</label>
	                        <input type="text" aria-labelledby="provide_details address_postcode_label" id="address_postcode" name="address-postcode" ' . set_value( 'address_postcode' ) . '>
	                        ' . field_error_message( 'addresss-postcode', 'Postcode' ) . '
	                    </div>
	                    <div class="form-row">
	                        <label id="address_country_label" for="address_country">Country</label>
	                        <input type="text" aria-labelledby="provide_details address_country_label" id="address_country" name="address-country" ' . set_value( 'address_country' ) . '>
	                        ' . field_error_message( 'addresss-country', 'Country' ) . '
	                    </div>

	                    </div>

			    <div class="form-row hidden">
	                        <label for="skype_name">Skype name (please ignore this field)</label>
	                        <input type="text" id="skype_name" name="skype-name-' . rand(10, 99) . '">
	                    </div>
	                    <div class="form-row">
	                        <input type="submit" alt="Submit" name="submit-bcf" id="submit-tna-form" value="Submit">
	                    </div>
	                </fieldset>
	            </form>';
	if ( isset( $_POST['submit-bcf'] ) ) {
        process_form_british_citizenship();
        // If the form submission comes with errors give us back
        // the form populated with form data and error messages
        if ( $tna_error_message ) {
            return $tna_error_message . $form;
        }
        // If the form is successful give us the confirmation content
        elseif ( $tna_success_message ) {
            return $tna_success_message . print_page();
        }
    }
	// If no form submission, hence the user has
	// accessed the page for the first time, give us an empty form
	else {
		return $content . $form;
	}
}
function process_form_british_citizenship() {
	// The processing happens at form submission.

		// Checks for token
        if ( isset( $_POST['token'] ) ) {
            $saved_token = get_transient('tna-token-'.$_POST['token']);
            if (!$saved_token) {
                $token = false;
            } else {
                $token = $_POST['token'];
                delete_transient('tna-token-'.$_POST['token']);
            }
        } else {
            $token = false;
        }

        $client_ip   = get_client_ip();

        if ( isset($_POST['email']) ) {
            $client_email = $_POST['email'];
        } else {
            $client_email = '';
        }

        $ip_status = check_ip( get_client_ip(), $client_email, $_POST['tna-form'], $_POST['timestamp'] );

        if ( $ip_status == false ) {
            $token = false;
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
			'Certificate holder\'s first name'   => 'Please enter the certificate holder’s first name',
			'Certificate holder\'s last name'   => 'Please enter the certificate first holder’s last name',
			'First name'                 => 'Please enter your first name',
			'Last name'                 => 'Please enter your last name',
			'Preferred contact'         => 'Please indicate your preferred method of contact',
			'Email'                     => 'Please enter a valid email address',
			'Confirm email'             => 'Please enter your email address again'
		);

		// Get the form elements and store them into an array
		// IMPORTANT: $form_fields array keys must match exactly the $tna_error_messages array keys
		$form_fields = array(
			'Certificate holder\'s first name'  => array(is_mandatory_text_field_valid( filter_input( INPUT_POST, 'certificate-first-name' ) ), 'subject_forename'),
			'Certificate holder\'s last name'   => array(is_mandatory_text_field_valid( filter_input( INPUT_POST, 'certificate-last-name' ) ), 'subject_surname'),
			'Alternative first name'            => array(is_text_field_valid( filter_input( INPUT_POST, 'certificate-first-name-alt' ) ), 'other_forename'),
			'Alternative last name'             => array(is_text_field_valid( filter_input( INPUT_POST, 'certificate-last-name-alt' ) ), 'other_surname'),
			'Country of birth'                  => array(is_text_field_valid( filter_input( INPUT_POST, 'certificate-birth-country' ) ), 'birth_country'),
			'DOB'                               => array(is_text_field_valid( filter_input( INPUT_POST, 'certificate-day' ) ) . '-' .
			                                       is_text_field_valid( filter_input( INPUT_POST, 'certificate-month' ) ) . '-' .
			                                       is_text_field_valid( filter_input( INPUT_POST, 'certificate-year' ) ), 'birth_date_noval'),
			'Approx DOB'                        => array(( isset( $_POST['certificate-dob-approx'] ) ) ? is_checkbox_radio_valid( filter_input( INPUT_POST, 'certificate-dob-approx' ) ) : 'No', 'mandatory_is_birth_date_approx'),
			'Certificate holder address'        => array(is_textarea_field_valid( filter_input( INPUT_POST, 'certificate-postal-address' ) ), 'certificate_holder_address'),
			'Country of issue'                  => array(is_text_field_valid( filter_input( INPUT_POST, 'certificate-issued-country' ) ), 'certificate_country_of_issue'),
			'Certificate number'                => array(is_text_field_valid( filter_input( INPUT_POST, 'certificate-number' ) ), 'certificate_numb'),
			'Issued from'                       => array(is_text_field_valid( filter_input( INPUT_POST, 'certificate-year-issued-from' ) ), 'registration_from_year'),
			'Issued to'                         => array(is_text_field_valid( filter_input( INPUT_POST, 'certificate-year-issued-to' ) ), 'registration_to_year'),
			'First name'                        => array(is_mandatory_text_field_valid( filter_input( INPUT_POST, 'first-name' ) ), 'contact_first_name'),
			'Last name'                         => array(is_mandatory_text_field_valid( filter_input( INPUT_POST, 'last-name' ) ), 'contact_last_name'),
			'Preferred contact'                 => array(( isset( $_POST['preferred-contact'] ) ) ? is_checkbox_radio_valid( filter_input( INPUT_POST, 'preferred-contact' ) ) : false, ''),
			'Email'                             => array(is_email_field_valid( filter_input( INPUT_POST, 'email' ) ), 'contact_email'),
			'Confirm email'                     => array(does_fields_match( $_POST['confirm-email'], $_POST['email'] ), ''),
			'Address line 1'                    => array(is_text_field_valid( filter_input( INPUT_POST, 'address-street-1' ) ), 'contact_address_1'),
			'Address line 2'                    => array(is_text_field_valid( filter_input( INPUT_POST, 'address-street-2' ) ), 'contact_address_2'),
			'Town or city'                      => array(is_text_field_valid( filter_input( INPUT_POST, 'address-town-city' ) ), 'contact_address_town_city'),
			'County'                            => array(is_text_field_valid( filter_input( INPUT_POST, 'address-county' ) ), 'contact_address_county'),
			'Postcode'                          => array(is_text_field_valid( filter_input( INPUT_POST, 'address-postcode' ) ), 'contact_address_postcode'),
			'Country'                           => array(is_text_field_valid( filter_input( INPUT_POST, 'address-country' ) ), 'contact_address_country'),
			'Spam'                              => array(is_this_spam( $_POST ), ''),
            'Token'                             => array($token, ''),
            'IP'                                => array($client_ip, '')
		);


		// If any value inside the array is false then there is an error
		if ( in_array( false, $form_fields ) ) {

			// Oops! Error!

			// Store error messages into the global variable
			$tna_error_message = display_error_message();
			log_spam( $form_fields['Spam'][0], date_timestamp_get( date_create() ), $form_fields['Email'][0] );

		} else {

			// Yay! Success!
			global $post;

			// Generate reference number based on user's surname and timestamp
			$ref_number = ref_number( 'TNA', date_timestamp_get( date_create() ) );
			$form_fields['Reference No'] = array($ref_number,'tna_reference');
			// Store confirmation content into the global variable
			$tna_success_message = success_message_header( 'Your reference number:', $ref_number );
			$tna_success_message .= confirmation_content( $post->ID );
			$tna_success_message .= '<p>If you provided your email address you will shortly receive an email confirming your application – please do not reply to this email</p>';
			$tna_success_message .= '<h3>Summary of your enquiry</h3>';
			$tna_success_message .= display_compiled_form_data( $form_fields );

			// Store email content to user into a variable
			$email_to_user = success_message_header( 'Your reference number:', $ref_number );
			$email_to_user .= confirmation_email_content( $post->ID );
			$email_to_user .= '<h3>Summary of your enquiry</h3>';
			$email_to_user .= display_compiled_form_data( $form_fields );

			// Send email to user
			if ( $form_fields['Email'][0] ) {
			send_form_via_email( $form_fields['Email'][0], 'Check for a certificate of British citizenship - Ref:', $ref_number,
				$email_to_user, $form_fields['Spam'][0] );
			}
			// Store email content to TNA into a variable
			$email_to_tna = tna_xml_form_data( $form_fields );
			// Send email to TNA
			send_form_via_email( get_tna_email(), '? FOI DIRECT NATCERT', '',
				$email_to_tna, $form_fields['Spam'][0] );
			log_spam( $form_fields['Spam'][0], date_timestamp_get( date_create() ), $form_fields['Email'][0] );
		}
}


function tna_xml_form_data( $data ) {

	if ( is_array( $data ) ) {
		foreach ( $data as $field_name => $field_value ) {
			if ( $field_value[1] == '') {
				// do nothing
			} else {
                                $display_data .= htmlspecialchars('<' . $field_value[1] . '>') . html_entity_decode($field_value[0], null, 'UTF-8') . htmlspecialchars('</' . $field_value[1] . '>') . '<br/>';
			}
		}
        $display_data .= '<p style="color:#fff";>Token: '.$data['Token'][0].'<br>This was received from IP '.$data['IP'][0].'</p>';

		return $display_data;
	}
}

function check_ip( $client_ip, $user_email, $id, $time_stamp ) {

    if (strpos($client_ip, ':') !== false) {
        $client_ip = current(explode(':', $client_ip));
    }

    if ( (time() - $time_stamp) < 3  ) {
        log_ip( $time_stamp, $user_email, 'Too fast - '.$id.' - '.$client_ip );
        return false;
    }

    $tans_id = str_replace(' ', '_', $id ).'_ip_'.$client_ip;

    $stored_ip = get_transient($tans_id);

    if ( !$stored_ip ) {
        set_transient( $tans_id, 1, 20*MINUTE_IN_SECONDS );
    } else {
        $n = $stored_ip+1;
        set_transient( $tans_id, $n, 20*MINUTE_IN_SECONDS );

        if ( $stored_ip > 3 ) {
            log_ip( $time_stamp, $user_email, $id.' - '.$client_ip );
            return false;
        }
    }
    return true;
}

function log_ip($time, $email, $ip ) {
    $file = plugin_dir_path( __FILE__ ) . 'ip_log.txt';
    $log  = $ip . ' : ' . $time . ' - ' . $email . PHP_EOL;
    file_put_contents( $file, $log, FILE_APPEND );
}
