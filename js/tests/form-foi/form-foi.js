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
        assert.ok($('form#foi', '.fixture').length == 1, "The form ID is present");
        assert.ok($('input[type=submit]', '.fixture').prop('disabled') == false, "The submit button is NOT disabled before the plugin has run");
        assert.equal($('input[type=hidden]', '.fixture').attr('name'), "formID", "The input type hidden field with the attribute name of tna-form is present");
    });
});

/**
 * 2. Checking the Fields before plugin is applied
 */
QUnit.module("Checking the fields before plugin is applied", function () {
    QUnit.test("Check required elements in fixture", function (assert) {
        assert.ok($('#title', '.fixture').length == 1, "The title input is present");
        assert.ok($('#forename', '.fixture').length == 1, "The forename input is present");
        assert.equal($('#mandatory_surname', '.fixture').val(), "", "The mandatory_surname is empty");
        assert.ok($('#mandatory_email', '.fixture').length == 1, "The mandatory_email input is present");
        assert.equal($('#mandatory_enquiry', '.fixture').val(), "", "The mandatory_enquiry address is empty");
        assert.equal($('#send-message', '.fixture').attr('name'), "send-message", "Name on input button is send-message");
    });
});