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
 * 5. Change form ID, unique and descriptive. ie form_begins( $id, $value )
 * 6. Change hidden input named 'tna-form' value, unique and descriptive. ie form_begins( $id, $value )
 * 7. All input IDs with two or more words use underscore.
 * 8. Change submit input name using naming convention 'submit-*'. ie submit_form( $name, $id, $value )
 *
 * Checklist for processing form:
 *
 * 1. Change processing function name, unique and descriptive. ie function process_form_*()
 * 2. Change add_action to reflect new function name. ie add_action('wp', 'process_form_*');
 * 3. Change first if statement to reflect the submit input name.
 * 4. Change $form_fields array to reflect the form inputs
 * 5. Update email subject for user and tna. ie send_form_via_email( $email, $ref_number, $subject, $content )
 * 6. Update tna destination email. ie get_tna_email( 'contactcentre' )
 *
 */

function return_form_foi( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-default'] ) ) {
		process_form_default();
	}

	// HTML form string
	$html = new Form_Builder;
	$form =  $html->form_begins( 'foi', 'Freedom of information', 'https://test.nationalarchives.gov.uk/contact/contactform.asp' ) .
	         $html->form_hidden_input( 'formID', '10') .
	         $html->fieldset_begins( 'Your enquiry' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Please enter your full name' ) .
	         $html->form_email_input( 'Email address', 'email', 'email', 'Please enter a valid email address' ) .
	         $html->form_email_input( 'Please re-type your email address', 'confirm_email', 'confirm-email', 'Please enter your email address again', 'email' ) .
	         $html->form_text_input( 'Country', 'country', 'country', 'Please enter your country' ) .
	         $html->form_textarea_input( 'Your enquiry', 'enquiry', 'enquiry', 'Please enter your enquiry', 'Please provide specific details of the information you are looking for.' ) .
	         $html->form_text_input( 'Provide the dates or years that you are interested in', 'dates', 'dates' ) .
	         $html->form_newsletter_checkbox() .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-default', 'submit-tna-form' ) .
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

