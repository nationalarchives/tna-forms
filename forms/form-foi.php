<?php
/**
 * Form: FOI
 *
 */

function return_form_foi() {

	// HTML form string
	$html = new Form_Builder;
	$form =  $html->form_foi_begins( 'https://test.nationalarchives.gov.uk/contact/contactform.asp', 'foi', 'contactForm' ) .
	         $html->form_hidden_input( 'formID', '10' ) .
	         $html->form_hidden_input( 'formType', '1' ) .
	         $html->form_hidden_input( 'formTitle', 'Freedom of Information enquiry' ) .
	         $html->form_hidden_input( 'formResponseTarget', '20 working days' ) .
	         $html->fieldset_begins( 'Your enquiry' ) .
	         $html->form_text_input( 'Title', 'title', 'title' ) .
	         $html->form_text_input( 'First name', 'forename', 'forename' ) .
	         $html->form_text_input( 'Last name', 'mandatory_surname', 'mandatory_surname', 'Please enter your last name' ) .
	         $html->form_email_input( 'Email address', 'mandatory_email', 'mandatory_email', 'Please enter a valid email address' ) .
	         $html->form_textarea_input( 'Your enquiry', 'mandatory_enquiry', 'mandatory_enquiry', 'Please enter your enquiry' ) .
	         $html->submit_form( 'send-message', 'send-message' ) .
	         $html->fieldset_ends() .
	         $html->form_ends();

	return $form;
}

