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

function return_form_request_assessment_document( $content ) {

    // Global variables to determine if the form submission
    // is successful or comes back with errors
    global $tna_success_message,
           $tna_error_message;

    $form_name = 'Request an assessment of a document';

    // If the form is submitted the form data is processed
    if ( isset( $_POST['submit-request-assessment-document'] ) ) {

        $process = new Form_Processor;
        $form_data = $process->get_data( $_POST );
        $process->process_data( $form_name, $form_data );
    }

    // HTML form string
    $html = new Form_Builder;
    $form =  $html->form_begins( 'request-assessment-document', $form_name, 'novalidate') .
        $html->fieldset_begins( 'Document details' ) .
        $html->form_text_input( 'Catalogue reference', 'catalogue_reference', 'catalogue-reference', 'Enter your catalogue reference number' ) .
        $html->form_checkbox_input('Conservation required', 'conservation_required', 'conservation-required') .
        $html->form_checkbox_input('Mould treatment required', 'mould_treatment_required', 'mould-treatment-required') .
        $html->fieldset_ends() .
        $html->fieldset_begins( 'Your details' ) .
        $html->form_text_input( 'Full name', 'full_name', 'full-name', 'Enter your full name') .
        $html->form_email_required_input() .
        $html->form_spam_filter( rand(10, 99) ) .
        $html->submit_form( 'submit-request-assessment-document', 'submit-tna-form' ) .
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
