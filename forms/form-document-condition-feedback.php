<?php
/**
 * Form: Document condition feedback
 *
 */

function return_form_dcf( $content ) {

    // Global variables to determine if the form submission
    // is successful or comes back with errors
    global $tna_success_message,
           $tna_error_message;

    $form_name = 'Document condition feedback';

    // If the form is submitted the form data is processed
    if ( isset( $_POST['submit-dcf'] ) ) {

        $process = new Form_Processor;
        $form_data = $process->get_data( $_POST );
        $process->process_data( $form_name, $form_data, 'dsddocumentcare', 'consenquiries' );
    }

    // HTML form string
    $html = new Form_Builder;
    $form =  $html->form_begins( 'dcf', $form_name ) .
        $html->fieldset_begins( 'Document details' ) .
        $html->form_text_input( 'Catalogue reference', 'catalogue_reference', 'catalogue-reference', 'Please enter your catalogue reference number' ) .
        $html->form_checkbox_input('Document is damaged', 'document_is_damaged', 'document-is-damaged') .
        $html->form_checkbox_input('Box/folder contains wrong document', 'contains_wrong_document', 'contains-wrong-document') .
        $html->form_checkbox_input('Pages not in correct order', 'no_in_correct_order', 'not-in-correct-order') .
        $html->form_textarea_input( 'Additional details', 'additional_details', 'additional-details' ) .
        $html->fieldset_ends() .
        $html->fieldset_begins( 'Your details' ) .
        $html->form_radio_group('Do you need someone from the team to email you a response to your feedback?','email-a-response', array('No','Yes')) .
        $html->form_text_input( 'Full name', 'full_name', 'full-name' ) .
        $html->form_email_input( 'Email address', 'email', 'email' ) .
        $html->form_email_input( 'Please re-type your email address', 'confirm_email', 'confirm-email', '', 'email' ) .
        $html->fieldset_ends() .
        $html->form_spam_filter( rand(10, 99) ) .
        $html->submit_form( 'submit-dcf', 'submit-tna-form' ) .
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
