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
        }

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
            "full-name": {
                required: true,
                noSpace: true
            },
            email: {
                required: true,
                email:true,
                advEmail:true
            },
            "confirm-email": {
                equalTo: "#email"
            },
            telephone:{
                required: true,
                noSpace: true
            },
            "job-title":{
                required:true,
                noSpace: true
            },
            organisation:{
                required:true,
                noSpace: true
            },
            address:{
                required:true,
                noSpace:true
            },
            "organisation-type":{
                required:true,
                noSpace: true
            },
            "your-role":{
                required:true,
                noSpace: true
            },
           "session-first-choice": {
                required:true,
                noSpace: true
            },
            "session-second-choice": {
                required:true,
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
            telephone:{
                required: "<span>*</span>Please enter your telephone number"
            },
            "job-title":{
                required:"<span>*</span>Please enter your job title"
            },
            organisation:{
                required:"<span>*</span>Please enter a department/agency/organisation"
            },
            address:{
                required:"<span>*</span>Please enter an address"
            },
            "organisation-type":{
                required:"<span>*</span>Please select an option"
            },
            "your-role":{
                required:"<span>*</span>Please select an option"
            },
            "session-first-choice": {
                required:"<span>*</span>Please select an option"
            },
            "session-second-choice": {
                required:"<span>*</span>Please select an option"
            }
        }
    });
}