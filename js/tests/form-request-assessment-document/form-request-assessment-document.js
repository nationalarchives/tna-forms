/**
 * THE NATIONAL ARCHIVES
 * ------------------------------------------------------------------------------
 * Your views qUnit tests
 * ------------------------------------------------------------------------------
 * 1. Checking the DOM before plugin is applied
 * 2. Checking the Fields before plugin is applied
 */

var inputAttributes = {
    form: {
        id: "request-assessment-document",
        submit: "#submit-tna-form",
        elem: {
            id : {
                1 : "full_name",
                2 : "email",
                3 : "confirm_email"
            },
            name: {
                1 : "full-name-required",
                2 : "email-required",
                3 : "confirm-email-required"
            }
        }
    }
};

/**
 * 1. Checking the DOM before plugin is applied
 */
QUnit.module("Checking the mandatory DOM elements before plugin is applied", function () {
    QUnit.test("Check required elements in fixture", function (assert) {
        assert.ok($('form', '.fixture').length == 1, "The form is present");
        assert.ok($('form#'+ inputAttributes.form.id , '.fixture').length == 1, "The form ID is present");
        assert.ok($('input[type=submit]', '.fixture').prop('disabled') == false, "The submit button is NOT disabled before the plugin has run");
        assert.equal($('input[type=hidden]', '.fixture').attr('name'), "tna-form", "The input type hidden field with the attribute name of tna-form is present");
    });
});

/**
 * 2. Checking the Fields before plugin is applied
 */
QUnit.module("Checking the fields before plugin is applied", function () {
    QUnit.test("Check required elements in fixture", function (assert) {

        /*for( var key in inputAttributes) {
                assert.ok($('#' + inputAttributes[key].elem.id, '.fixture').length == 1, "The " + inputAttributes[key].elem.id +" input is present");
        }*/

        assert.equal($('#email', '.fixture').val(), "", "The email address is empty");

        assert.equal($('#confirm_email', '.fixture').val(), "", "The confirm email address is empty");

        assert.equal($('#submit-tna-form', '.fixture').attr('name'), "submit-request-assessment-document", "Attribute name is valid");
    });
});