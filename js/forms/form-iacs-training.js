/**
 * @contact-form-name: IACS Training form
 *
 * ----- Table of contents -------------------------------------
 *
 * 1. Define variables
 * 2. Include custom form methods from methods.js
 * 3. Check if value in drop down sessions does not match
 * 4. Add the validation rules
 * */

function iacsTrainingForm(){
    /**
     * 1. Declare variables
     * */
    var formName = "#iacs_training";
    var form = $(formName);

    /**
     * 2. Included custom form validation methods from methods.js
     * */
    formMethods();

    /**
     * 3. Check if value in drop down sessions does not match
     * */

    // Declare self executing function and keep all my variables inside this scope
    (function(){

        // Declare variables
        var $firstSession = $('#session_first_choice');
        var $secondSession = $('#session_second_choice');

        // Declare anonymous function
        var compareSessions = function (sessionOne, sessionTwo){
            sessionOne.change(function() {
                sessionTwo.find('option').prop("disabled", false);
                var selectedItem = $(this).val();
                if (selectedItem) {
                    sessionTwo.find('option[value="' + selectedItem + '"]').prop("disabled", true);
                }
            });
        };

        // Compare session 1 with 2
        compareSessions($firstSession,$secondSession);
        // Compare session 2 with 1
        compareSessions($secondSession,$firstSession);
    })();

    /**
     * 4. Add the validation rules
     * */
    form.validate({
        errorElement: 'span',
        errorClass: 'form-error form-hint',
        highlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').addClass("form-warning");
            $(element).closest('input[type="email"]').addClass("form-warning");
            $(element).closest('input[type="tel"]').addClass("form-warning");
            $(element).closest('textarea').addClass("form-warning");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('input[type="text"]').removeClass("form-warning");
            $(element).closest('input[type="email"]').removeClass("form-warning");
            $(element).closest('input[type="tel"]').removeClass("form-warning");
            $(element).closest('textarea').removeClass("form-warning");
        },
        rules: {
            "full-name-required": {
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
            "telephone-required":{
                required: true,
                noSpace: true
            },
            "job-title-required":{
                required:true,
                noSpace: true
            },
            "organisation-required":{
                required:true,
                noSpace: true
            },
            "address-required":{
                required:true,
                noSpace:true
            },
            "organisation-type-required":{
                required:true,
                noSpace: true
            },
            "your-role-required":{
                required:true,
                noSpace: true
            },
           "session-first-choice-required": {
                required:true,
                noSpace: true
            },
            "session-second-choice-required": {
                required:true,
                noSpace: true
            }

        },
        /**
         * Error messages
         * */
        messages: {
            "full-name-required": {
                required: "Please enter your full name"
            },
            "email-required": "Please enter your email address",
            "confirm-email-required": {
                required:"Please enter your email address",
                equalTo: "Please enter your email address again"
            },
            "telephone-required":{
                required: "Please enter your telephone number"
            },
            "job-title-required":{
                required:"Please enter your job title"
            },
            "organisation-required":{
                required:"Please enter a department/agency/organisation"
            },
            "address-required":{
                required:"Please enter an address"
            },
            "organisation-type-required":{
                required:"Please select an option"
            },
            "your-role-required":{
                required:"Please select an option"
            },
            "session-first-choice-required": {
                required:"Please select an option"
            },
            "session-second-choice-required": {
                required:"Please select an option"
            }
        }
    });

    $("input[name='submit-iacs']").on('click', function(){
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