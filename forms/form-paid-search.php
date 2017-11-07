<?php
/**
 * Form: Request a paid search
 */

function return_form_paid_search($content)
{

    // Global variables to determine if the form submission
    // is successful or comes back with errors
    global $tna_success_message,
           $tna_error_message;

    $form_name = 'Request a paid search';

    // If the form is submitted the form data is processed
    if ( isset( $_POST['submit-paid-search'] ) ) {

        $process = new Form_Processor;
        $form_data = $process->get_data( $_POST );
        $process->process_data( $form_name, $form_data );
    }

    // HTML form string
    $html = new Form_Builder_Two;
    $form = $html->form_begins('paid_search', $form_name) .
        $html->fieldset_begins('Your details') .
        $html->form_text_input('Full name', 'full_name', 'full-name', 'Please enter your full name') .
        $html->form_email_required_input() .
        $html->form_text_input('Country', 'country', 'country', 'Please enter your country') .
        $html->fieldset_ends() .
        $html->fieldset_begins('Details of your search enquiry') .
        $html->help_text("Be as specific as possible about the person or subject you are looking for. Please avoid asking us for 'anything you can find'. <br />If you are looking for records of a person, please include their full name, place of birth, and date of birth. <br /> If you are not looking for records of a person, please include a range of dates or years to search within, and relevant record series references.") .
        $html->form_textarea_input('Your enquiry', 'your_enquiry', 'your-enquiry', 'Please provide specific details of the information you are looking for, including any relevant catalogue references.') .
        $html->fieldset_ends() .
        $html->form_spam_filter(rand(10, 99)) .
        $html->submit_form('submit-paid-search', 'submit-tna-form') .
        $html->fieldset_ends() .
        $html->form_ends();

    // If the form submission comes with errors give us back
    // the form populated with form data and error messages
    if ($tna_error_message) {
        return $tna_error_message . $form;
    } // If the form is successful give us the confirmation content
    elseif ($tna_success_message) {
        return $tna_success_message . print_page();
    }

    // If no form submission, hence the user has
    // accessed the page for the first time, give us an empty form
    else {
        return $content . $form;
    }
}
