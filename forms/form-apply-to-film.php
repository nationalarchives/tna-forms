<?php
/**
 * Form: Apply to film
 *
 */

function return_form_apply_to_film( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'Apply to film at The National Archives';

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-atf'] ) ) {

		$process = new Form_Processor;
		$form_data = $process->get_data( $_POST );
		$process->process_data( $form_name, $form_data );
	}

	// HTML form string
	$html = new Form_Builder_Two;
	$form =  $html->form_begins( 'apply-to-film', $form_name ) .
	         $html->fieldset_begins( 'Your details' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_required_input() .
	         $html->form_text_input( 'Company', 'company', 'company' ) .
	         $html->form_text_input( 'Job title', 'job_title', 'job-title' ) .
	         $html->form_tel_input( 'Telephone', 'telephone', 'telephone', '', 'Include the area code' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'About the project' ) .
	         $html->form_date_input( 'Preferred date of filming', 'date', 'date', 'Please enter your filming date' ) .
	         $html->form_text_input( 'Preferred time of filming', 'time', 'time', '', 'Use the 24 hour clock format, eg 15:00') .
	         $html->form_textarea_input( 'How will it be broadcast and when will it be transmitted? Is it part of a series?', 'broadcast', 'broadcast' ) .
	         $html->form_textarea_input( 'Please list the documents you would like to film, providing full references', 'documents', 'documents' ) .
	         $html->form_checkbox_input( 'Tick this box if you want to interview a member of staff', 'interview', 'interview' ) .
	         $html->form_text_input( 'If you know the name of the staff member you want to interview, enter it here', 'interviewee', 'interviewee' ) .
	         $html->form_checkbox_input( 'I have read and agreed to the filming <a href="http://nationalarchives.gov.uk/documents/filming-terms-and-conditions.pdf" target="_blank">terms and conditions</a>, including the charges and cancellation policy', 'policy', 'policy', 'Please confirm you have read and agree to the terms and conditions' ) .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-atf', 'submit-tna-form' ) .
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
