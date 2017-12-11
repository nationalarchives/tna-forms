/**
 * THE NATIONAL ARCHIVES
 * ------------------------------------------------------------------------------
 * Archive Update qUnit tests
 * ------------------------------------------------------------------------------
 */

// Define the Form object
var form = {
    fixture: "fixture",
    id: "archive_update",
    submitName: "submit-aup",
    submitId: "submit-tna-form",
    typeSubmit: "input[type=submit]",
    typeHidden: "input[type=hidden]",
    elem: [
        {id: "full_name", name: "full-name-required"},
        {id: "email", name: "email-required"},
        {id: "confirm_email", name: "confirm-email-required"},
        {id: "name_of_repository", name: "name-of-repository-required"},
        {id: "archon_code", name: "archon-code"},
        {id: "address_of_repository", name: "address-of-repository"},
        {id: "address_for_correspondence", name: "address-for-correspondence"},
        {id: "telephone_number_for_general_enquiries", name: "telephone-number-for-general-enquiries"},
        {id: "email_general_enquiries", name: "email-general-enquiries"},
        {id: "repository_website_url", name: "repository-website-url"},
        {id: "title", name: "title"},
        {id: "first_name", name: "first-name"},
        {id: "last_name", name: "last-name"},
        {id: "job_title", name: "job-title"},
        {id: "job_title", name: "job-title"},
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