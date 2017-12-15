<?php
/**
 * Form: PRONOM
 *
 */

function return_form_pronom( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'PRONOM';

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-pr'] ) ) {

		$process = new Form_Processor;
		$form_data = $process->get_data( $_POST );
		$process->process_data( $form_name, $form_data );
	}

	// HTML form string
	$html = new Form_Builder;
	$form =  $html->form_begins( 'pronom', $form_name ) .
	         $html->fieldset_begins( 'Your details' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_required_input() .
	         $html->form_text_input( 'Organisation', 'organisation', 'organisation' ) .
	         $html->form_textarea_input( 'How did you find out about PRONOM?', 'find_out', 'find-out' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Your request' ) .
	         $html->help_text( 'New entry / update to existing entry' ) .
	         $html->help_text( 'Please suggest particular file formats you would like more information on. These can be formats which are not currently listed in the PRONOM database, or formats which have an incomplete entry in PRONOM.' ) .
	         $html->form_text_input( 'File format to investigate', 'file_format', 'file-format', 'Please enter the file format' ) .
	         $html->form_checkbox_input( 'Tick here if you have an example of the file format', 'file_example', 'file-example' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Your submission' ) .
	         $html->help_text( 'Additional information' ) .
	         $html->help_text( 'If you have specific technical information about the file format concerned, please provide it here.' ) .
	         $html->form_text_input( 'PUID', 'puid', 'puid' ) .
	         $html->form_textarea_input( 'References', 'references', 'references', '', 'To provide validity / authenticity to the entry' ) .
	         $html->form_textarea_input( 'Other information you can tell us about the format', 'other_information', 'other-information', '', 'For example, version; vendor / developer; file extension' ) .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-pr', 'submit-tna-form' ) .
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
