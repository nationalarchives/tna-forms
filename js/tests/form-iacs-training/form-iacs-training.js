/**
 * THE NATIONAL ARCHIVES
 * ------------------------------------------------------------------------------
 * IACS Training qUnit tests
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
        assert.ok($('form#iacs_training', '.fixture').length == 1, "The form ID is present");
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
        assert.ok($('#telephone').length == 1, "The telephone input is present");
        assert.ok($('#job_title').length == 1, "Job title input is present");
        assert.ok($('#organisation').length == 1, "Department/agency.organisation input is present");
        assert.ok($('#address').length == 1, "Address");
        assert.ok($('#organisation_type').length == 1, "Describe organisation select input is present");
        assert.ok($('#other_organisation').length == 1, "Other organisation input is present");
        assert.ok($('#your_role').length == 1, "Your role input is present");
        assert.ok($('#role_other').length == 1, "Other role input is present");
        assert.ok($('#role_length').length == 1, "Role length input is present");
        assert.ok($('#session_first_choice').length == 1, "Session first choice select is present");
        assert.ok($('#session_second_choice').length == 1, "Session second choice select is present");
        assert.ok($('#previous_training').length == 1, "Previous training first choice select is present");
        assert.ok($('#previous_training_details').length == 1, "Previous training details textarea is present");
        assert.equal($('#submit-tna-form', '.fixture').attr('name'), "submit-iacs", "Name on input button is submit-iacs");
    });
});