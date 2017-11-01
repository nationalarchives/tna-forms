<?php
/**
 * Form: Your views
 *
 */

function return_form_your_views( $content ) {

	// Global variables to determine if the form submission
	// is successful or comes back with errors
	global $tna_success_message,
	       $tna_error_message;

	$form_name = 'Your views';

	// If the form is submitted the form data is processed
	if ( isset( $_POST['submit-yv'] ) ) {

		$process = new Form_Processor;
		$form_data = $process->get_data( $_POST );
		$process->process_data( $form_name, $form_data );
	}

	// HTML form string
	$html = new Form_Builder_Two;
	$form =  $html->form_begins( 'your-views', $form_name ) .
	         $html->fieldset_begins( 'Your details' ) .
	         $html->form_text_input( 'Full name', 'full_name', 'full-name' ) .
	         $html->form_email_input( 'Email address', 'email', 'email' ) .
	         $html->form_email_input( 'Please re-type your email address', 'confirm_email', 'confirm-email', '', 'email' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Your message' ) .
	         $html->form_select_input( 'Reason for contact', 'reason', 'reason', array('Compliment', 'Suggestion or comment', 'Criticism or concern', 'Complaint'), 'Please select an option' ) .
	         $html->form_textarea_input( 'Your enquiry', 'enquiry', 'enquiry', 'Please enter your enquiry' ) .
	         $html->fieldset_ends() .
	         $html->fieldset_begins( 'Additional record information' ) .
	         $html->help_text( 'Please enter an order number or catalogue reference if either are relevant to this message.' ) .
	         $html->form_text_input( 'Order number or catalogue reference', 'order_number_cat_ref', 'order-number-cat-ref' ) .
	         $html->form_spam_filter( rand(10, 99) ) .
	         $html->submit_form( 'submit-yv', 'submit-tna-form' ) .
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
