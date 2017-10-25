<?php
/**
 * Form template
 *
 * Checklist for new forms:
 *
 * 1. Create new form using form-default.php
 * 2. Change form function name, unique and descriptive. ie function return_form_*()
 * 3. Update shortcode function with new form function.
 * 4. Include newly created form file to tna-forms.php includes
 * 5. Change form ID, unique and descriptive. ie form_begins( $id, $value )
 * 6. Change hidden input named 'tna-form' value, unique and descriptive. ie form_begins( $id, $value )
 * 7. All input IDs with two or more words use underscore.
 * 8. Change submit input name using naming convention 'submit-*'. ie submit_form( $name, $id, $value )
 *
 * Checklist for processing form:
 *
 * 1. Change processing function name, unique and descriptive. ie function process_form_*()
 * 2. Change add_action to reflect new function name. ie add_action('wp', 'process_form_*');
 * 3. Change first if statement to reflect the submit input name.
 * 4. Change $form_fields array to reflect the form inputs
 * 5. Update email subject for user and tna. ie send_form_via_email( $email, $ref_number, $subject, $content )
 * 6. Update tna destination email. ie get_tna_email( 'contactcentre' )
 *
 */

function return_form_archive_update( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-aup'] ) ) {
		process_form_archive_update();
	}

	// HTML form string
	$html = new Form_Builder;
	$form =  $html->form_begins( 'archive_update', 'Archive Update' ) .
	         $html->fieldset_begins( 'Details of submitting officer' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_input( 'Email address', 'email', 'email', 'Please enter a valid email address' ) .
	         $html->form_email_input( 'Please re-type your email address', 'confirm_email', 'confirm-email', 'Please enter your email address again', 'email' ) .
             $html->form_select_input('Are you submitting a new entry or updating an existing entry?', 'type_of_entry', 'type-of-entry', array('New','Update'), 'Please select from the dropdown') .
             $html->fieldset_ends() .
             $html->fieldset_begins('Repository details').
             $html->form_text_input('Name of repository', 'name_of_repository','name-of-repository', 'Please enter your name of repository').
             $html->form_text_input('Archon code', 'archon_code', 'archon-code').
             $html->form_textarea_input('Address','address_of_repository','address-of-repository').
             $html->form_textarea_input('Address for correspondence if different from above','address_for_correspondence','address-for-correspondence').
             $html->form_tel_input('Telephone/fax number for general enquiries', 'telephone_number_for_general_enquiries', 'telephone-number-for-general-enquiries') .
             $html->form_email_input( 'Email address for general enquiries', 'email_general_enquiries', 'email-general-enquiries' ) .
             $html->form_text_input('Repository website', 'repository_website_url','repository-website-url') .
             $html->fieldset_ends() .
             $html->fieldset_begins( 'Details of person in charge of the repository' ) .
             $html->form_text_input('Title','title','title').
             $html->form_text_input('First name','first_name','first-name').
             $html->form_text_input('Last name','last_name','last-name') .
             $html->form_text_input('Job title','job_title','job-title') .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Repository visiting details' ) .
             $html->form_text_input('Usual opening hours','usual_opening_hours', 'usual-opening-hours','','For example, Mon-Thurs 9am-5pm; Fri 9am-12pm') .
             $html->form_text_input('Dates of annual closure','dates_of_annual_closure','dates-of-annual-closure') .
             $html->form_select_input('Do visitors need to book in advance?','booking_in_advance','booking-in-advance', array('Yes','No')) .
             $html->form_text_input('Requirements for public access to MSS','requirements_for_public_access_to_mss', 'requirements-for-public-access-to-mss','','For example, CARN ticket, letter of introduction or proof of identity') .
             $html->form_select_input('Is a reader ticket required?','is_a_reader_ticket_required', 'is-a-reader-ticket-required',array('Yes','No')) .
             $html->form_select_input('Is a fee payable?','is_a_fee_payable', 'is-a-fee-payable',array('Yes','No')) .
             $html->form_select_input('Is there disability access?','is_there_disability_access', 'is-there-disability-access',array('Yes','No')) .
             $html->form_text_input('Is there a copy service?','copy_service','copy-service', '', 'For example, photographs, microfilm') .
             $html->form_select_input('Do you provide a fee based research service?','fee_based_research_service', 'fee-based-research-service',array('Yes','No')) .
             $html->form_text_input('Details of finding aids available on website','aids_available_on_website','aids-available-on-website','','For example, catalogue URL ') .
             $html->form_textarea_input('Is there a published guide to the repository? If so, give details', 'published_guide', 'published-guide') .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Additional information' ) .
	         $html->form_textarea_input( 'Please supply any additional information here', 'additional_information', 'additional-information', '', 'For example, fields to be deleted' ) .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-aup', 'submit-tna-form' ) .
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

function process_form_archive_update() {

	// Global variables
	global $tna_success_message,
	       $tna_error_message;

	// Setting global variables
	$tna_success_message = '';
	$tna_error_message   = '';

	// Get the form elements and store them into an array
	$form_fields = array(
		'Full Name'                                                                                                          => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'full-name' ) ),
		'Email address'                                                                                                      => is_mandatory_email_field_valid( filter_input( INPUT_POST, 'email' ) ),
		'Please re-type your email address'                                                                                  => does_fields_match( $_POST['confirm-email'], $_POST['email'] ),
		'Type of entry: new/update'                                                                                          => is_mandatory_select_valid(filter_input(INPUT_POST,'type-of-entry')),
		'Name of repository'                                                                                                 => is_mandatory_text_field_valid(filter_input(INPUT_POST, 'name-of-repository')),
		'Archon code'                                                                                                        => is_text_field_valid(filter_input(INPUT_POST, 'archon-code')),
		'Address'                                                                                                            => is_textarea_field_valid(filter_input(INPUT_POST, 'address-of-repository')),
		'Address for correspondence (if different from above)'                                                               => is_textarea_field_valid(filter_input(INPUT_POST, 'address-for-correspondence')),
		'Telephone number for general enquiries'                                                                             => is_text_field_valid(filter_input(INPUT_POST, 'telephone-number-for-general-enquiries')),
		'Email address for general enquiries'                                                                                => is_text_field_valid(filter_input(INPUT_POST, 'email-general-enquiries')),
		'Repository website URL'                                                                                             => is_text_field_valid(filter_input(INPUT_POST, 'repository-website-url')),
		'Title'                                                                                                              => is_text_field_valid(filter_input(INPUT_POST, 'title')),
		'First name'                                                                                                         => is_text_field_valid(filter_input(INPUT_POST, 'first-name')),
		'Last name'                                                                                                          => is_text_field_valid(filter_input(INPUT_POST, 'last-name')),
		'Job title'                                                                                                          => is_text_field_valid(filter_input(INPUT_POST, 'job-title')),
		'Usual opening hours'                                                                                                => is_text_field_valid(filter_input(INPUT_POST, 'usual-opening-hours')),
        'Dates of annual closure'                                                                                            => is_text_field_valid(filter_input(INPUT_POST, 'dates-of-annual-closure')),
		'Booking in advance? Yes/No'                                                                                         => is_select_valid(filter_input(INPUT_POST,'booking-in-advance')),
		'Requirements for public access to MSS eg CARN ticket, letter of introduction or proof of identity'                  => is_text_field_valid(filter_input(INPUT_POST, 'requirements-for-public-access-to-mss')),
        'Is a reader ticket required? Yes/No'                                                                                => is_select_valid(filter_input(INPUT_POST,'is-a-reader-ticket-required')),
        'Is a fee payable? Yes/No'                                                                                           => is_select_valid(filter_input(INPUT_POST,'is-a-fee-payable')),
        'Is there disability access? Yes/No'                                                                                 => is_select_valid(filter_input(INPUT_POST,'is-there-disability-access')),
        'Is there a copy service? If so, in what format eg photographs, microfilm, etc'                                      => is_text_field_valid(filter_input(INPUT_POST, 'copy-service')),
        'Do you provide a fee based research service?'                                                                       => is_select_valid(filter_input(INPUT_POST,'fee-based-research-service')),
        'Details of finding aids available on website'                                                                       => is_text_field_valid(filter_input(INPUT_POST, 'aids-available-on-website')),
		'Is there a published guide to the repository?'                                                                      => is_textarea_field_valid(filter_input(INPUT_POST,'published-guide')),
		'Please supply any additional information here, eg fields to be deleted.'                                            => is_textarea_field_valid(filter_input(INPUT_POST,'additional-information')),
		'Spam'                                                   => is_this_spam( $_POST )
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
		$tna_success_message .= '<h3>Summary of your enquiry</h3>';
		$tna_success_message .= display_compiled_form_data( $form_fields );

		// Store email content to user into a variable
		$email_to_user = success_message_header( 'Your reference number:', $ref_number );
		$email_to_user .= confirmation_email_content( $post->ID );
		$email_to_user .= '<h3>Summary of your enquiry</h3>';
		$email_to_user .= display_compiled_form_data( $form_fields );

		// Send email to user
		send_form_via_email( $form_fields['Email'], 'Your enquiry - Ref:', $ref_number, $email_to_user, $form_fields['Spam'] );

		// Store email content to TNA into a variable
		$email_to_tna = success_message_header( 'Reference number:', $ref_number );
		$email_to_tna .= display_compiled_form_data( $form_fields );

		// Send email to TNA
		// Amend email address function with username to send email to desired destination.
		// eg, get_tna_email( 'contactcentre' )
		send_form_via_email( get_tna_email(), 'Enquiry - Ref:', $ref_number, $email_to_tna, $form_fields['Spam'] );
		log_spam( $form_fields['Spam'], date_timestamp_get( date_create() ), $form_fields['Email'] );
	}
}
