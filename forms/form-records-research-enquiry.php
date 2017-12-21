<?php
/**
 * Form: Records and research enquiry (RRE)
 *
 */

function return_form_rre( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'Records and research enquiry';

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-rre'] ) ) {

		$process = new Form_Processor;
		$form_data = $process->get_data( $_POST );
		$process->process_data( $form_name, $form_data );
	}

	// HTML form string (I know, it's long!)
	$html = new Form_Builder;
	$form =  $html->form_begins( 'records-research-enquiry', $form_name ) .
	         $html->fieldset_begins( 'Your enquiry' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_required_input() .
	         $html->form_text_input( 'Country', 'country', 'country' ) .
	         $html->form_textarea_input( 'Your enquiry', 'enquiry', 'enquiry', 'Please enter your enquiry', 'Please provide specific details of the information you are looking for, including any relevant catalogue references.' ) .
	         $html->form_text_input( 'Dates or years that you are interested in', 'dates', 'dates' ) .
	         $html->form_newsletter_checkbox() .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-rre', 'submit-tna-form' ) .
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
