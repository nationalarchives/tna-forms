/**
 * @contact-form-name: Apply to film
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function pronomForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#pronom";
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
            "full-name": {
                required: true,
                noSpace: true
            },
            email: {
                required: true,
                email:true
            },
            "confirm-email": {
                equalTo: "#email"
            },
            "file-format":{
                required: true,
                noSpace: true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name": {
                required: "<span>*</span>Please enter your full name"
            },
            email: "<span>*</span>Please enter your email address",
            "confirm-email": {
                required:"<span>*</span>Please enter your email address",
                equalTo: "<span>*</span>Please enter your email address again"
            },
            "file-format":{
                required:"<span>*</span>Please enter the file format"
            }
        }
    });

    $("input[name='submit-pr']").on('click', function(){
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