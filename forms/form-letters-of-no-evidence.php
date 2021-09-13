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
        $process->process_data($form_name, $form_data, '','', true);
    }

    // HTML form string
    $html = new Form_Builder;
    $form = $html->form_begins('letters_of_no_evidence', $form_name, 'novalidate') .
        $html->fieldset_begins('Personal details of the subject of the search') .
        $html->form_text_input('First name', 'first_name', 'first-name') .
        $html->form_text_input('Last name', 'last_name', 'last-name', 'Enter the last name of the subject') .
        $html->form_text_input('Alternative first name', 'alternative_first_name', 'alternative-first-name', '','For example, married or Anglicised names.') .
        $html->form_text_input('Alternative Last name', 'alternative_last_name', 'alternative-last-name') .
        $html->form_text_input('Date of birth', 'date_of_birth', 'date-of-birth', 'Enter a date of birth, even if it is the approximate year.', 'For example, 04/07/1901 or July 1901.<br>If you don’t know the exact date, enter the approximate year.') .
        $html->form_text_input('Date of death', 'date_of_death', 'date_of_death', '', 'For example, 04/07/1928 or July 1920.<br>If you don’t know the exact date, enter the approximate year.') .
        $html->form_text_input('Country of birth', 'country_of_birth', 'country-of-birth') .
        $html->fieldset_ends() .
        $html->fieldset_begins('Your contact details') .
        $html->help_text('Provide your details so we can let you know the outcome of the search for evidence of naturalisation.') .
        $html->form_text_input('Title', 'title_contact', 'title-contact') .
        $html->form_text_input('First name', 'first_name_contact', 'first-name-contact') .
        $html->form_text_input('Last name', 'last_name_contact', 'last-name-contact', 'Enter your last name') .
        $html->form_email_required_input() .
        $html->form_text_input('Address line 1', 'address_1', 'address-street-1','Enter your addesss') .
        $html->form_text_input('Address line 2', 'address_2', 'address-street-2') .
        $html->form_text_input('Town or city', 'address_town_city', 'address-town-city', 'Enter your town or city') .
        $html->form_text_input('County', 'address_county', 'address-county') .
        $html->form_text_input('Postcode', 'address_postcode', 'address-postcode', 'Enter your postcode') .
        $html->form_text_input('Country', 'address_country', 'address-country', 'Enter your country') .
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
