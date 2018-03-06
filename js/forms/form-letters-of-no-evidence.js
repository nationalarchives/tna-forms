/**
 * @contact-form-name: Letters of no evidence
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function lettersOfNoEvidenceForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#letters_of_no_evidence";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
                required: true,
                noSpace: true
            },
            "full-name-contact-details-required":{
                required: true
            },
            "date-of-birth-required":{
                required: true,
                noSpace: true
            },
            "email-required": {
                required: true,
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "postal-address-required":{
                required: true,
                noSpace: true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required": {
                required:"Enter the full name of the subject"
            },
            "email-required": "Enter your email address",
            "confirm-email-required": {
                required: "Enter your email address",
                equalTo: "Enter your email address again so we know it is correct"
            },
            "full-name-contact-details-required":{
                required: "Enter the full name of the subject"
            },
            "date-of-birth-required":{
                required: "Enter a date of birth, even if it is the approximate year"
            },
            "postal-address-required":{
                required:"Enter your postal address"
            }
        }
    });

    $("input[name='submit-letters-of-no-evidence']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">There was a problem</p><p>Check the highlighted fields.</p></div>');
            }
        }
    });
}