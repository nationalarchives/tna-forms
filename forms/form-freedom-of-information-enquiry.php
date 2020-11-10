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
 * 6. All input IDs with two or more words use underscore. ie 'full_name'
 * 7. All input name atts with two or more words use dash. ie 'full-name'
 * 8. Update tna destination email. ie process_data( $form_name, $form_data, 'contactcentre' )
 *
 */

function return_form_foie( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'Freedom of information enquiry';

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-foie'] ) ) {

		$process = new Form_Processor;
		$form_data = $process->get_data( $_POST );
		$process->process_data( $form_name, $form_data, 'foiteam', '', true);
	}

	// HTML form string
	$html = new Form_Builder;
	$form =  $html->form_begins( 'foie', $form_name, 'novalidate' ) .
	         $html->fieldset_begins( 'Your details' ) .
	         $html->form_text_input( 'Title', 'title', 'title') .
			 $html->form_text_input( 'First Name', 'first_name', 'first-name') .
	         $html->form_text_input( 'Last name', 'last_name', 'last-name', 'Please enter your last name' ) .
	         $html->form_email_required_input() .
	         $html->form_textarea_input( 'Your enquiry', 'enquiry', 'enquiry', 'Please enter your enquiry', 'Please provide specific details of the information you are looking for.' ) .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-foie', 'submit-tna-form' ) .
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
