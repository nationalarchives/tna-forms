/**
 * @contact-form-name: Your Views form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 *
 * */
function dcfForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#dcf";
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
                noSpace: true
            },
            email: {
                email:true
            },
            "confirm-email": {
                equalTo: "#email"
            },
            "catalogue-reference":{
                required: true,
                noSpace: true
            },
            enquiry:{
                noSpace:true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "confirm-email": {
                equalTo: "<span>*</span>Please enter your email address again"
            },
            "catalogue-reference":{
                required: "<span>*</span>Please enter your catalogue reference number"
            },
        }
    });

    $("input[name='submit-dcf']").on('click', function(){
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