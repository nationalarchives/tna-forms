/**
 * THE NATIONAL ARCHIVES
 * ------------------------------------------------------------------------------
 * Your views qUnit tests
 * ------------------------------------------------------------------------------
 */

// Define the Form object
var form = {
    fixture: "fixture",
    id: "your-views",
    submitName: "submit-yv",
    submitId: "submit-tna-form",
    typeSubmit: "input[type=submit]",
    typeHidden: "input[type=hidden]",
    elem: [
        {id: "full_name", name: "full-name"},
        {id: "email", name: "email"},
        {id: "confirm_email", name: "confirm-email"},
        {id: "reason", name: "reason-required"},
        {id: "enquiry", name: "enquiry-required"},
        {id: "order_number_cat_ref", name: "order-number-cat-ref"}
    ]
};

/**
 * 1. Checking the DOM before plugin is applied
 */
QUnit.module("Checking the mandatory DOM elements before plugin is applied", function () {
    QUnit.test("Check required elements in fixture", function (assert) {
        assert.ok($('form', '.'+form.fixture).length === 1, "The form is present");
        assert.ok($('form#'+form.id, '.'+form.fixture).length === 1, "The form ID " + form.id +" is present");
        assert.ok($(form.typeSubmit, '.'+form.fixture).prop('disabled') === false, "The submit button is NOT disabled before the plugin has run");
        assert.equal($(form.typeHidden, '.'+form.fixture).attr('name'), "tna-form", "The input type hidden field with the attribute name of tna-form is present");
    });
});

/**
 * 2. Checking the Fields before plugin is applied
 */
QUnit.module("Checking the fields before plugin is applied", function () {

    QUnit.test("Check required elements in fixture by id", function (assert) {

        for (var ok = 0; ok < form.elem.length; ok++) {
            assert.ok($('#' + form.elem[ok].id, '.'+form.fixture).length === 1, "ID -> " + form.elem[ok].id + " input is present");
        }

    });

    QUnit.test("Check required elements in fixture by name", function (assert) {

        for (var e = 0; e < form.elem.length; e++) {
            assert.equal($('#' + form.elem[e].id, '.'+form.fixture).attr('name'), form.elem[e].name, "Input -> attribute name " + form.elem[e].name + " is present");
        }

        assert.equal($('#' + form.submitId, '.'+form.fixture).attr('name'), form.submitName, "Button -> attribute name " + form.submitName + " is present");

    });

    QUnit.test("Check inputs if empty", function (assert) {

        for (var equals = 1; equals < form.elem.length; equals++) {
            assert.equal($('#' + form.elem[equals].id, '.'+form.fixture).val(), "", "Input -> " + form.elem[equals].id + " is empty");
        }

    });

});