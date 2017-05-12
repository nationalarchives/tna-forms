/**
 * THE NATIONAL ARCHIVES
 * ------------------------------------------------------------------------------
 * Apply to film qUnit tests
 * ------------------------------------------------------------------------------
 * 1. Checking the DOM before plugin is applied
 * 2. Checking the Fields before plugin is applied
 */


/**
 * 1. Checking the DOM before plugin is applied
 */
QUnit.module("Checking the mandatory DOM elements before plugin is applied", function () {
    QUnit.test("Check required elements in fixture", function (assert) {
        assert.ok($('form', '.fixture').length == 1, "The form is present");
        assert.ok($('form#archive_update', '.fixture').length == 1, "The form ID is present");
        assert.ok($('input[type=submit]', '.fixture').prop('disabled') == false, "The submit button is NOT disabled before the plugin has run");
        assert.equal($('input[type=hidden]', '.fixture').attr('name'), "tna-form", "The input type hidden field with the attribute name of tna-form is present");
    });
});

/**
 * 2. Checking the Fields before plugin is applied
 */
QUnit.module("Checking the fields before plugin is applied", function () {
    QUnit.test("Check required elements in fixture", function (assert) {
        assert.ok($('#full_name', '.fixture').length == 1, "The full_name input is present");
        assert.ok($('#email', '.fixture').length == 1, "The email input is present");
        assert.equal($('#email', '.fixture').val(), "", "The email address is empty");
        assert.ok($('#confirm_email', '.fixture').length == 1, "The confirm email input is present");
        assert.equal($('#confirm_email', '.fixture').val(), "", "The confirm email address is empty");
        assert.ok($('#additional_information').length == 1, "The additional information textarea is present");
        assert.ok($('#type_of_enty').length == 1, "The type of enty dropdown is present");
        assert.ok($('#name_of_repository').length == 1, "The name of repository input is present");
        assert.ok($('#archon_code').length == 1, "The archon code input is present");
        assert.ok($('#address_of_repository').length == 1, "The address of repository textarea is present");
        assert.ok($('#address_for_correspondence').length == 1, "The address for correspondence textarea is present");
        assert.ok($('#full_name_of_person_in_charge').length == 1, "The full name of person in charge input is present");
        assert.ok($('#job_title_of_person_in_charge').length == 1, "The job title of person in charge input is present");
        assert.ok($('#telephone_number_for_general_enquiries').length == 1, "The telephone number for general enquiries input is present");
        assert.ok($('#email_general_enquiries').length == 1, "The email general enquiries input is present");
        assert.ok($('#email_general_enquiries').length == 1, "The email general enquiries input is present");
        assert.ok($('#repository_website_url').length == 1, "The repository website url input is present");
        assert.ok($('#usual_opening_hours').length == 1, "The usual opening hours input is present");
        assert.ok($('#dates_of_annual_closure').length == 1, "The dates of annual closure input is present");
        assert.ok($('#booking_in_advance').length == 1, "The booking in advance dropdown is present");
        assert.ok($('#requirements_for_public_access_to_mss').length == 1, "The requirements for public access to mss input is present");
        assert.ok($('#is_a_reader_ticket_required').length == 1, "The is a reader ticket required dropdown is present");
        assert.ok($('#is_a_fee_payable').length == 1, "The is a fee payable dropdown is present");
        assert.ok($('#is_there_disability_access').length == 1, "The is there disability access dropdown is present");
        assert.ok($('#copy_service').length == 1, "The copy service input is present");
        assert.ok($('#fee_based_research_service').length == 1, "The fee based research service dropdown is present");
        assert.ok($('#aids_available_on_website').length == 1, "The aids available on website input is present");
        assert.ok($('#published_guide').length == 1, "The published guide textarea is present");
        assert.ok($('#additional_information').length == 1, "The additional information textarea is present");
        assert.equal($('#submit-tna-form', '.fixture').attr('name'), "submit-aup", "Name on input button is submit-pr");
    });
});