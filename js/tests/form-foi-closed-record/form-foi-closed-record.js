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
        assert.ok($('form#foi_closed_record', '.fixture').length == 1, "The form ID is present");
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
        assert.ok($('#telephone_number').length == 1, "The telephone number input is present");
        assert.ok($('#enquiry', '.fixture').length == 1, "The enquiry textarea is present");
        assert.ok($('#postal_address', '.fixture').length == 1, "The postal address textarea is present");
        assert.ok($('#DOCREF').length == 1, "The catalogue reference input is present");
        assert.equal($('#submit-tna-form', '.fixture').attr('name'), "submit-foi-closed-record", "Name on input button is foi-closed-record");
    });
});