<?php
/**
 * Apply for training form
 *
 */

function return_form_apply_for_training( $sessions, $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'Apply for training';

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-aft'] ) ) {

		$process = new Form_Processor;
		$form_data = $process->get_data( $_POST );
		$process->process_data( $form_name, $form_data );
	}

	// HTML form string
	$html = new Form_Builder;
	$form =  $html->form_begins( 'default', $form_name ) .
	         $html->fieldset_begins( 'Your contact details' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_required_input() .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Your job details' ) .
	         $html->form_text_input( 'Job title', 'job_title', 'job-title', 'Please enter your job title' ) .
	         $html->form_text_input( 'Department/agency/organisation', 'department_agency_organisation', 'department-agency-organisation', 'Please enter your department, agency or organisation' ) .
	         $html->form_textarea_input( 'Postal address', 'postal', 'postal', 'Please enter your postal address' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Line manager details' ) .
	         $html->hint_text( 'Please enter "N/A" if not applicable.' ) .
	         $html->form_text_input( 'Full name', 'line_manager_full_name', 'line-manager-full-name' ) .
	         $html->form_email_input( 'Email address', 'line_manager_email', 'line-manager-email' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Session details' ) .
	         $html->form_select_input_training( 'Session (1st choice)', 'session_first_choice', 'session-first-choice', $sessions, 'Please select an option' ) .
	         $html->form_select_input_training( 'Session (2nd choice)', 'session_second_choice', 'session-second-choice', $sessions, 'Please select an option' ) .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-aft', 'submit-tna-form' ) .
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
