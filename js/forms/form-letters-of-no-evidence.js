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
            "frst-name-required": {
                required: false,
                noSpace: true
            },
            "last-name-required": {
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
            "address-1-required": {
                required: true,
                noSpace: true
            },
            "address-town-required": {
                required: true,
                noSpace: true
            },
            "address-postcode-required": {
                required: true,
                noSpace: true
            },
            "address-country-required": {
                required: true,
                noSpace: true
            },
            "file-format-required":{
                required: true,
                noSpace: true
            },
	    "alternative-last-name":{
		required: true,
		noSpace: true
	    }

        },
        /**
         * Error messages
         * */
        messages: {
            "first-name-required": {
                required:"Please enter your first name"
            },
             "last-name-required": {
                required:"Please enter your last name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "address-1-required": {
                required:"Please enter address"
            },
            "address-town-required":{
                required:"Please enter your town or city"
            },
            "address-postcode-required":{
                required:"Please enter your postcode"
            },
            "address-country-required": {
                required:"Please enter your country"
            },
            "file-format-required":{
                required:"Please enter the file format"
            }
        }
    });

    $("input[name='submit-letters-of-no-evidence']").on('click', function(){
        var emphAlert = ($('.emphasis-block.error-message').length === 1);
        if(form.valid() !== true) {
            if(emphAlert) {
                $('.emphasis-block.error-message').show();
            } else {
                $(form).before().prepend('<div class="emphasis-block error-message" role="alert"><p class="h3">Sorry, there was a problem</p><p>Please check the highlighted fields to proceed.</p></div>');
            }
        }
    });
}
