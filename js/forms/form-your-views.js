/**
 * @contact-form-name: Your Views form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Add the validation rules
 * */

function yourViewsForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#your-views";
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
            reason:{
                required: true,
                noSpace: true
            },
            enquiry:{
                required:true,
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
            reason:{
                required: "<span>*</span>Please select an option"
            },
            enquiry:{
                required:"<span>*</span>Please enter your enquiry"
            }
        }
    });
}