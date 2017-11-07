<?php
/**
 * Form: Information Assurance and Cyber Security training
 *
 */

function return_form_iacs_training( $sessions, $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'Information Assurance and Cyber Security training';

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-iacs'] ) ) {

		$process = new Form_Processor;
		$form_data = $process->get_data( $_POST );
		$process->process_data( $form_name, $form_data );
	}

	// HTML form string
	$html = new Form_Builder_Two;
	$form =  $html->form_begins( 'iacs_training', $form_name ) .
	         $html->fieldset_begins( 'Your details' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_required_input() .
	         $html->form_tel_input( 'Telephone', 'telephone', 'telephone', 'Please enter your telephone number', '(include area code)' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Organisation details' ) .
	         $html->form_text_input( 'Job title', 'job_title', 'job-title', 'Please enter your job title' ) .
	         $html->form_text_input( 'Department/agency/organisation', 'organisation', 'organisation', 'Please enter a department/agency/organisation' ) .
	         $html->form_textarea_input( 'Address', 'address', 'address', 'Please enter an address' ) .
	         $html->form_select_input( 'Which of the following best describes your organisation?', 'organisation_type', 'organisation-type', array(
		         'Ministerial Department',
		         'Non-Ministerial Department',
		         'Executive Agency',
		         'Non-Departmental Public Body',
		         'Local Government',
		         'Police/Fire',
		         'NHS',
		         'Other - please specify below'
	         ), 'Please select an option' ) .
	         $html->form_text_input( 'Organisation, if \'Other\', please specify', 'other_organisation', 'other-organisation' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Role details' ) .
	         $html->form_select_input( 'Which of the following best describes your role?', 'your_role', 'your-role', array(
		         'SIRO',
		         'Audit Committee member',
		         'Executive Agency',
		         'Board member',
		         'IAO',
		         'Other IA role - please specify below'
	         ), 'Please select an option' ) .
	         $html->form_text_input( 'Role, if \'Other\', please specify', 'role_other', 'role-other' ) .
	         $html->form_text_input( 'How long have you held this role?', 'role_length', 'role-length' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Session details' ) .
	         $html->form_select_input_training( 'Session (1st choice)', 'session_first_choice', 'session-first-choice', $sessions, 'Please select an option' ) .
	         $html->form_select_input_training( 'Session (2nd choice)', 'session_second_choice', 'session-second-choice', $sessions, 'Please select an option' ) .
	         $html->form_select_input( 'Have you previously done any IA training?', 'previous_training', 'previous-training', array('Yes', 'No') ) .
	         $html->form_textarea_input( 'If yes, please provide details', 'previous_training_details', 'previous-training-details' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Notify me' ) .
	         $html->form_checkbox_input( 'Do you want to receive our monthly SIRO newsletter or be updated about upcoming events?', 'newsletter', 'newsletter' ) .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-iacs', 'submit-tna-form' ) .
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
