<?php
/**
 * Form: Archive Update
 *
 */

function return_form_archive_update( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'Archive Update';

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-aup'] ) ) {

		$process = new Form_Processor;
		$form_data = $process->get_data( $_POST );
		$process->process_data( $form_name, $form_data );
	}

	// HTML form string
	$html = new Form_Builder_Two;
	$form =  $html->form_begins( 'archive_update', $form_name ) .
	         $html->fieldset_begins( 'Details of submitting officer' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_required_input() .
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
             $html->form_select_input('Is a reader ticket required?','reader_ticket', 'reader-ticket',array('Yes','No')) .
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
