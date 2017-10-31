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
 * 5. Change form from name. ie $form_name = 'Enquiry';
 * 6. All input IDs with two or more words use underscore.
 * 7. Update tna destination email. ie process_form( $form_name, 'contactcentre' )
 *
 */

function return_form_default( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'Default';
	$form_id = strtolower( str_replace(' ', '_', $form_name) );

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit_'.$form_id] ) ) {

		$form_data = get_form_data( $_POST );
		process_form( $form_name, $form_data );
	}

	// HTML form string
	$html = new Form_Builder_Two;
	$form =  $html->form_begins( $form_id, $form_name ) .
	         $html->fieldset_begins( 'Your enquiry' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_required_input() .
	         $html->form_text_input( 'Country', 'country', 'country', 'Please enter your country' ) .
	         $html->form_textarea_input( 'Your enquiry', 'enquiry', 'enquiry', 'Please enter your enquiry', 'Please provide specific details of the information you are looking for.' ) .
	         $html->form_text_input( 'Provide the dates or years that you are interested in', 'dates', 'dates' ) .
	         $html->form_newsletter_checkbox() .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit_'.$form_id, 'submit-tna-form' ) .
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
