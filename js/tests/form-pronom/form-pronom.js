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
        assert.ok($('form#pronom', '.fixture').length == 1, "The form ID is present");
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
        assert.ok($('#organisation').length == 1, "The organisation input is present");
        assert.ok($('#find_out').length == 1, "The find_out textarea is present");
        assert.ok($('#file_format').length == 1, "The file_format input is present");
        assert.ok($('#file_example').length == 1, "The file_example checkbox is present");
        assert.ok($('#puid').length == 1, "The puid input is present");
        assert.ok($('#references').length == 1, "The references textarea is present");
        assert.ok($('#other_information').length == 1, "The other_information textarea is present");
        assert.equal($('#submit-tna-form', '.fixture').attr('name'), "submit-pr", "Name on input button is submit-pr");
    });
});