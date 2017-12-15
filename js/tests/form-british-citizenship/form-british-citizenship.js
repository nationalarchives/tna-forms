/**
 * THE NATIONAL ARCHIVES
 * ------------------------------------------------------------------------------
 * British Citizenship qUnit tests
 * ------------------------------------------------------------------------------
 */

// Define the Form object
var form = {
    fixture: "fixture",
    id: "naturalisation",
    submitName: "submit-bc",
    submitId: "submit-tna-form",
    typeSubmit: "input[type=submit]",
    typeHidden: "input[type=hidden]",
    elem: [
        {id: "certificate_name", name: "certificate-name"},
        {id: "certificate_name_alt", name: "certificate-name-alt"},
        {id: "certificate_birth_country", name: "certificate-birth-country"},
        {id: "certificate_day", name: "certificate-day"},
        {id: "certificate_month", name: "certificate-month"},
        {id: "certificate_year", name: "certificate-year"},
        {id: "certificate_dob_approx", name: "certificate-dob-approx"},
        {id: "certificate_postal_address", name: "certificate-postal-address"},
        {id: "certificate_issued_country", name: "certificate-issued-country"},
        {id: "certificate_number", name: "certificate-number"},
        {id: "certificate_year_issued_from", name: "certificate-year-issued-from"},
        {id: "certificate_year_issued_to", name: "certificate-year-issued-to"},
        {id: "full_name", name: "full-name"},
        {id: "email", name: "email"},
        {id: "confirm_email", name: "confirm-email"},
        {id: "postal_address", name: "postal-address"}
    ]
};

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