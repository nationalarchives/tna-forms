/**
 * @contact-form-name: Public sector form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function paidSearchForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#paid_search";
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
            "title": {
                required: false,
                noSpace: true
            },
            "first-name": {
                required: true,
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
            "country-required":{
                required:true,
                noSpace:true
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
            "first-name-required": {
                required: "Please enter your first name"
            },
            "last-name-required": {
                required: "Please enter your last name"
            },
            "email-required": "Please enter your email address",
            "country-required": "Please enter your country",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "enquiry-required": {
                required:"Please provide specific details of the information you are looking for, including any relevant catalogue references."
            }   
        }
    });


    $("input[name='submit-paid-search']").on('click', function(){
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