<?php
/**
 * Form: General enquires
 *
 */

function return_form_general( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'General enquires';

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-ge'] ) ) {

		$process = new Form_Processor;
		$form_data = $process->get_data( $_POST );
		$process->process_data( $form_name, $form_data );
	}

	// HTML form string
	$html = new Form_Builder;
	$form =  $html->form_begins( 'general', $form_name ) .
	         $html->fieldset_begins( 'Your details' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_input( 'Email address', 'email', 'email', 'Please enter a valid email address' ) .
	         $html->form_email_input( 'Please re-type your email address', 'confirm_email', 'confirm-email', 'Please enter your email address again', 'email' ) .
	         $html->form_text_input( 'Country', 'country', 'country', 'Please enter your country' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Your enquiry' ) .
	         $html->form_select_input( 'Reason for contact', 'reason', 'reason', array('Website enquiry or support', 'General enquiry'), 'Please select an option' ) .
	         $html->form_textarea_input( 'Your enquiry', 'enquiry', 'enquiry', 'Please enter your enquiry' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Additional information' ) .
	         $html->form_text_input( 'Catalogue reference', 'catalogue_reference', 'catalogue-reference' ) .
	         $html->form_newsletter_checkbox() .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-ge', 'submit-tna-form' ) .
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
