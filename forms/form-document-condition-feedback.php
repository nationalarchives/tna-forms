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

function return_form_dcf( $content ) {

    // Global variables to determine if the form submission
    // is successful or comes back with errors
    global $tna_success_message,
           $tna_error_message;

    // If the form is submitted the form data is processed
    if ( isset( $_POST['submit-dcf'] ) ) {
        process_form_dcf();
    }

    // HTML form string
    $html = new Form_Builder;
    $form =  $html->form_begins( 'dcf', 'Document condition feedback' ) .
        $html->fieldset_begins( 'Your details' ) .
        $html->form_text_input( 'Full name', 'full_name', 'full-name' ) .
        $html->form_email_input( 'Email address', 'email', 'email' ) .
        $html->form_email_input( 'Please re-type your email address', 'confirm_email', 'confirm-email', '', 'email' ) .
        $html->fieldset_ends() .
        $html->fieldset_begins( 'Document details' ) .
        $html->form_text_input( 'Catalogue reference', 'catalogue_reference', 'catalogue-reference', 'Please enter your catalogue reference number' ) .
        $html->form_checkbox_input('Document is damaged', 'document_is_damaged', 'document-is-damaged') .
        $html->form_checkbox_input('Box/folder contains wrong document', 'contains_wrong_document', 'contains-wrong-document') .
        $html->form_checkbox_input('Pages not in correct order', 'no_in_correct_order', 'not-in-correct-order') .
        $html->fieldset_ends() .
        $html->fieldset_begins('Additional details') .
        $html->form_textarea_input( 'Your enquiry', 'enquiry', 'enquiry', '', 'Please provide specific details of the information you are looking for.' ) .
        $html->form_radio_group('Do you need someone from the team to email you a response to your feedback?','email-a-response', array('No','Yes')) .
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

function process_form_dcf() {

    // Global variables
    global $tna_success_message,
           $tna_error_message;

    // Setting global variables
    $tna_success_message = '';
    $tna_error_message   = '';

    // Get the form elements and store them into an array
    $form_fields = array(
        'Name'                                => is_text_field_valid( filter_input( INPUT_POST, 'full-name' ) ),
        'Email'                               => is_email_field_valid( filter_input( INPUT_POST, 'email' ) ),
        'Confirm email'                       => does_fields_match( $_POST['confirm-email'], $_POST['email'] ),
        'Catalogue reference'                 => is_mandatory_text_field_valid( filter_input( INPUT_POST, 'catalogue-reference')),
        'Document is damaged'                 => is_checkbox_valid( filter_input( INPUT_POST, 'document-is-damaged')),
        'Box/folder contains wrong document'  => is_checkbox_valid( filter_input( INPUT_POST, 'contains-wrong-document')),
        'Pages not in correct order'          => is_checkbox_valid( filter_input( INPUT_POST, 'not-in-correct-order')),
        'Enquiry'                             => is_textarea_field_valid( filter_input( INPUT_POST, 'enquiry' ) ),
        'Response to your feedback'           => is_radio_valid( filter_input( INPUT_POST, 'email-a-response')),
        'Spam'                                => is_this_spam( $_POST )
    );

    // If any value inside the array is false then there is an error
    if ( in_array( false, $form_fields ) ) {

        // Oops! Error!

        // Store error message into the global variable
        $tna_error_message = display_error_message();

        log_spam( $form_fields['Spam'], date_timestamp_get( date_create() ), $form_fields['Email'] );

    } else {

        // Yay! Success!

        global $post;
        // Generate reference number based on user's surname and timestamp
        $ref_number = ref_number( 'TNA', date_timestamp_get( date_create() ) );

        // Store confirmation content into the global variable
        $tna_success_message = success_message_header( 'Your reference number:', $ref_number );
        $tna_success_message .= confirmation_content( $post->ID );
        $tna_success_message .= '<h3>Summary of your enquiry</h3>';
        $tna_success_message .= display_compiled_form_data( $form_fields );

        // Store email content to user into a variable
        $email_to_user = success_message_header( 'Your reference number:', $ref_number );
        $email_to_user .= confirmation_content( $post->ID );
        $email_to_user .= '<h3>Summary of your enquiry</h3>';
        $email_to_user .= display_compiled_form_data( $form_fields );

        // Send email to user
        send_form_via_email( $form_fields['Email'], 'Your enquiry - Ref:', $ref_number, $email_to_user, $form_fields['Spam'] );

        // Store email content to TNA into a variable
        $email_to_tna = success_message_header( 'Reference number:', $ref_number );
        $email_to_tna .= display_compiled_form_data( $form_fields );

        // Send email to TNA
        // Amend email address function with username to send email to desired destination.
        // eg, get_tna_email( 'contactcentre' )
        send_form_via_email( get_tna_email(), 'Enquiry - Ref:', $ref_number, $email_to_tna, $form_fields['Spam'] );

        // Subscribe to newsletter
        subscribe_to_newsletter( $form_fields['Newsletter'], $form_fields['Name'], $form_fields['Email'], 'Default', $form_fields['Spam'] );

        log_spam( $form_fields['Spam'], date_timestamp_get( date_create() ), $form_fields['Email'] );

    }
}