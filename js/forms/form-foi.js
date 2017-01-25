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

function foiForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#foi";
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
            "mandatory_surname":{
                required:true,
                noSpace:true
            },
            "mandatory_email": {
                required: true,
                email:true
            },
            "mandatory_enquiry":{
                required:true,
                noSpace:true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "mandatory_surname":{
                required:"<span>*</span>Please insert your last name"
            },
            "mandatory_email": "<span>*</span>Please enter your email address",
            "mandatory_enquiry":{
                required:"<span>*</span>Please enter your enquiry"
            }
        }
    });
}