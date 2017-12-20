/**
 * THE NATIONAL ARCHIVES
 * ------------------------------------------------------------------------------
 * Public sector qUnit tests
 * ------------------------------------------------------------------------------
 */

// Define the Form object
var form = {
    fixture: "fixture",
    id: "public-sector",
    submitName: "submit-psi",
    submitId: "submit-tna-form",
    typeSubmit: "input[type=submit]",
    typeHidden: "input[type=hidden]",
    elem: [
        {id: "full_name", name: "full-name-required"},
        {id: "email", name: "email-required"},
        {id: "confirm_email", name: "confirm-email-required"},
        {id: "reason", name: "reason"},
        {id: "enquiry", name: "enquiry-required"}
    ],
    regex : /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
    emails: [
        {valid: "m@m.com", invalid: "m@m."},
        {valid: "my_test@test.co.uk", invalid: "@test.co.uk"},
        {valid: "someEmails@yahoo.com", invalid: "someEmails@@yahoo.com"},
        {valid: "attack@gmail.co.uk", invalid: "attack@gmail.co.uk."}
    ]
};
function isValidEmail(str, reg) {
    return reg.test(str);
}
/**
 * 1. Checking the DOM before plugin is applied
 */
QUnit.module("Checking the mandatory DOM elements before plugin is applied", function () {
    QUnit.test("Check required elements in fixture", function (assert) {
        assert.ok($('form', '.' + form.fixture).length === 1, "The form is present");
        assert.ok($('form#' + form.id, '.' + form.fixture).length === 1, "The form ID " + form.id + " is present");
        assert.ok($(form.typeSubmit, '.' + form.fixture).prop('disabled') === false, "The submit button is NOT disabled before the plugin has run");
        assert.equal($(form.typeHidden, '.' + form.fixture).attr('name'), "tna-form", "The input type hidden field with the attribute name of tna-form is present");
    });
});

/**
 * 2. Checking the Fields before plugin is applied
 */
QUnit.module("Checking the fields before plugin is applied", function () {

    QUnit.test("Check required elements in fixture by id", function (assert) {
        for (var ok = 0; ok < form.elem.length; ok++) {
            assert.ok($('#' + form.elem[ok].id, '.' + form.fixture).length === 1, "Element -> with ID " + form.elem[ok].id + " is present");
        }
    });

    QUnit.test("Check required elements in fixture by name", function (assert) {
        for (var e = 0; e < form.elem.length; e++) {
            assert.equal($('#' + form.elem[e].id, '.' + form.fixture).attr('name'), form.elem[e].name, "Element -> attribute name " + form.elem[e].name + " is present");
        }
        assert.equal($('#' + form.submitId, '.' + form.fixture).attr('name'), form.submitName, "Button -> attribute name " + form.submitName + " is present");
    });

    QUnit.test("Check inputs if empty", function (assert) {
        for (var ok = 0; ok < form.elem.length; ok++) {
            if (form.elem[ok].id === "email" || form.elem[ok].id === "confirm_email") {
                assert.equal($('#' + form.elem[ok].id, '.' + form.fixture).val(), "", "Input -> " + form.elem[ok].id + " is empty");
            }
        }
    });
});

QUnit.module("Checking email address", function () {
    QUnit.test("Is valid", function (assert) {
        for (var i = 0; i < form.emails.length; i++) {
            assert.ok(isValidEmail(form.emails[i].valid, form.regex), form.emails[i].valid + " email address is valid");
        }
    });

    QUnit.test("Is invalid", function (assert) {
        for (var i = 0; i < form.emails.length; i++) {
            assert.notOk(isValidEmail(form.emails[i].invalid, form.regex), form.emails[i].invalid + " email address is invalid");
        }
    });
});