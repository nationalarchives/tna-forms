/**
 * @contact-form-name: Records Research Enquiry form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 *
 * */

function recordsResearchEnquiryForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#records-research-enquiry";
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
            "full-name-required":{
                required:true,
                noSpace:true
            },
            "email-required": {
                required: true,
                email:true
            },
            "confirm-email-required": {
                equalTo: "#email"
            },
            "enquiry-required":{
                required:true,
                noSpace:true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required":{
                required:"Please insert your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "enquiry-required":{
                required:"Please enter your enquiry"
            }
        }
    });

    $("input[name='submit-rre']").on('click', function(){
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