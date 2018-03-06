<?php
/**
 * Form: Letters of no evidence
 *
 */

function return_form_letters_of_no_evidence($content)
{

    // Global variables to determine if the form submission
    // is successful or comes back with errors
    global $tna_success_message,
           $tna_error_message;

    $form_name = 'Letters of no evidence';

    // If the form is submitted the form data is processed
    if (isset($_POST['submit-letters-of-no-evidence'])) {

        $process = new Form_Processor;
        $form_data = $process->get_data($_POST);
        $process->process_data($form_name, $form_data);
    }

    // HTML form string
    $html = new Form_Builder;
    $form = $html->form_begins('letters_of_no_evidence', $form_name) .
        $html->fieldset_begins('Subject\'s personal details') .
        $html->form_text_input('Full name', 'full_name', 'full-name', 'Enter the full name of the subject') .
        $html->form_text_input('Alternative name(s)', 'alternative_names', 'alternative-names', '', 'For example, married or Anglicised names.') .
        $html->form_text_input('Date of birth', 'date_of_birth', 'date-of-birth', 'Enter a date of birth, even if it is the approximate year.', 'If you don’t know the exact date, the approximate year <br/> should be enough for us to do a search.') .
        $html->form_text_input('Date of death', 'date_of_death', 'date_of_death', '', 'If you don’t know the exact date, the approximate year <br/> should be enough for us to do a search.') .
        $html->form_text_input('Country of birth', 'country_of_birth', 'country-of-birth') .
        $html->fieldset_ends() .
        $html->fieldset_begins('Your contact details') .
        $html->help_text('Provide your details so we can let you know the outcome of the search for evidence of naturalisation.') .
        $html->form_text_input('Full name', 'full_name_contact_details', 'full-name-contact-details', 'Enter your full name') .
        $html->form_email_required_input() .
        $html->form_textarea_input('Postal address', 'postal_address', 'postal-address', 'Enter your postal address.') .
        $html->form_spam_filter(rand(10, 99)) .
        $html->submit_form('submit-letters-of-no-evidence', 'submit-tna-form') .
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
