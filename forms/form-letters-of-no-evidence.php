<?php
/**
 * Form: Letters of no evidence
 *
 */

function return_form_letters_of_no_evidence( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'Letters of no evidence';

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-letters-of-no-evidence'] ) ) {

		$process = new Form_Processor;
		$form_data = $process->get_data( $_POST );
		$process->process_data( $form_name, $form_data );
	}

	// HTML form string
	$html = new Form_Builder;
	$form =  $html->form_begins( 'letters_of_no_evidence', $form_name, 'no-validate' ) .
	         $html->fieldset_begins( 'Subject\'s personal details' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter subject\'s full name' ) .
	         $html->form_text_input( 'Alternative name(s)', 'alternative_names', 'alternative-names','','Enter any other names that the subject may have been known by.' ) .
             $html->form_text_input( 'Birth or death dates', 'birth_or_death_dates', 'birth-or-death-dates','Please enter the birth or death dates','Enter the approximate year range in which they may have lived.' ) .
             $html->form_text_input( 'Nationality at time of possible application for naturalisation', 'nationality_at_time_of_possible_application_for_naturalisation', 'nationality-at-time-of-possible-application-for-naturalisation') .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Your contact details') .
             $html->help_text('Provide your details so we can let you know the outcome of the search for evidence of naturalisation.') .
             $html->form_text_input( 'Full name', 'full_name_contact_details', 'full-name-contact-details', 'Please enter your full name' ) .
	         $html->form_email_required_input() .
	         $html->form_textarea_input( 'Postal address', 'postal_address', 'postal-address', 'Please enter your postal address' ) .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-letters-of-no-evidence', 'submit-tna-form' ) .
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
