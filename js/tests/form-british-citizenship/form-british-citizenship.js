/**
 * THE NATIONAL ARCHIVES
 * ------------------------------------------------------------------------------
 * Newsletter JQuery validation tests
 * ------------------------------------------------------------------------------
 * 1. Checking the DOM before plugin is applied
 * 2. Checking the custom utilities created for this plugin
 * 3. State of the DOM after the plugin has run
 * 4. State of the DOM in response to user interactions
 * 5. If an invalid string is provided, the submit button should be disabled again
 * 6. If an empty string is provided, the submit button should be disabled again
 */


/**
 * 1. Checking the DOM before plugin is applied
 */
QUnit.module("Checking the mandatory DOM elements before plugin is applied", function () {
    QUnit.test("Check required elements in fixture", function (assert) {
        assert.ok($('form', '.fixture').length == 1, "The form is present");
        assert.ok($('form#naturalisation', '.fixture').length == 1, "The form ID is present");
        assert.ok($('input[type=submit]', '.fixture').prop('disabled') == false, "The submit button is NOT disabled before the plugin has run");
        assert.equal($('input[type=hidden]', '.fixture').attr('name'), "tna-form", "The input type hidden field with the attribute name of tna-form is present");
    });
});

/**
 * 1. Checking the Fields before plugin is applied
 */
QUnit.module("Checking the fields before plugin is applied", function () {
    QUnit.test("Check required elements in fixture", function (assert) {
        assert.ok($('#certificate_name', '.fixture').length == 1, "The certificate_name input is present");
        assert.ok($('#certificate_name_alt', '.fixture').length == 1, "The certificate_name_alt input is present");
        assert.ok($('#certificate_birth_country', '.fixture').length == 1, "The certificate_birth_country input is present");
        assert.ok($('#certificate_day', '.fixture').length == 1, "The certificate_day input is present");
        assert.ok($('#certificate_month', '.fixture').length == 1, "The certificate_month input is present");
        assert.ok($('#certificate_year', '.fixture').length == 1, "The certificate_year input is present");
        assert.ok($('#certificate_dob_approx', '.fixture').length == 1, "The certificate_dob_approx check box is present");
        assert.ok($('#certificate_postal_address', '.fixture').length == 1, "The certificate_postal_address textarea is present");
        assert.ok($('#certificate_issued_country', '.fixture').length == 1, "The certificate_issued_country input is present");
        assert.ok($('#certificate_number', '.fixture').length == 1, "The certificate_number input is present");
        assert.ok($('#certificate_year_issued_from', '.fixture').length == 1, "The certificate_year_issued_from select is present");
        assert.ok($('#certificate_year_issued_to', '.fixture').length == 1, "The certificate_year_issued_to select is present");
        assert.ok($('#full_name', '.fixture').length == 1, "The full_name input is present");
        assert.ok($('#contact_email', '.fixture').length == 1, "The contact_email radio is present");
        assert.ok($('#contact_postal', '.fixture').length == 1, "The contact_postal radio is present");
        assert.ok($('#postal_address', '.fixture').length == 1, "The postal_address textarea is present");
        assert.ok($('#email', '.fixture').length == 1, "The email input is present");
        assert.equal($('#email', '.fixture').val(), "", "The email address is empty");
        assert.ok($('#confirm_email', '.fixture').length == 1, "The confirm email input is present");
        assert.equal($('#confirm_email', '.fixture').val(), "", "The confirm email address is empty");
        assert.equal($('#submit-tna-form', '.fixture').attr('name'), "submit-bc", "Name on input button is submit-bc");
    });
});